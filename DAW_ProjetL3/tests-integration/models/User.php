<?php
class User {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getUserByEmail($email) {
        $query = $this->db->prepare("SELECT * FROM users WHERE EMAIL = :email");
        $query->execute(['email' => $email]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        /*
        $result = $query->fetch(PDO::FETCH_ASSOC);
        echo "Query result: ";
        print_r($result);
        echo "<br>";
        */
        return $result;
    }


    public function getUserById($id) {
        $query = $this->db->prepare("SELECT * FROM users WHERE ID = :id");
        $query->execute(['id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function createUser($name, $firstname, $email, $password, $role, $pp, $tag) {
        $password = sha1($password);
        $query = $this->db->prepare("INSERT INTO users (NAME, FIRSTNAME, EMAIL, PASSWORD, ROLE, PP, TAGS) VALUES (:name, :firstname, :email, :password, :role, :pp, :tag)");
        $query->execute([
            'name' => $name,
            'firstname' => $firstname,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'pp' => $pp,
            'tag' => $tag
        ]);

        return $this->db->lastInsertId();
    }

    public function updateUser($id, $name, $firstname, $email, $password, $role, $pp, $tag) {
        $password = sha1($password);
        if(strlen($pp) > 1) {
            $query = $this->db->prepare("UPDATE users SET NAME = :name, FIRSTNAME = :firstname, EMAIL = :email, PASSWORD = :password, ROLE = :role, PP = :pp WHERE ID = :id");
            $query->execute([
                'id' => $id,
                'name' => $name,
                'firstname' => $firstname,
                'email' => $email,
                'password' => $password,
                'role' => $role,
                'pp' => $pp
            ]);
        } else {
            $query = $this->db->prepare("UPDATE users SET NAME = :name, FIRSTNAME = :firstname, EMAIL = :email, PASSWORD = :password, ROLE = :role WHERE ID = :id");
            $query->execute([
                'id' => $id,
                'name' => $name,
                'firstname' => $firstname,
                'email' => $email,
                'password' => $password,
                'role' => $role
            ]);
        }
        return $query->rowCount();
    }

    public function deleteUser($id) {
        $query = $this->db->prepare("DELETE FROM users WHERE ID = :id");
        $query->execute(['id' => $id]);

        return $query->rowCount();
    }

    public function getCoursesByUserId($userId) {
        $query = $this->db->prepare("SELECT c.* FROM cours c JOIN inscription i ON c.ID = i.ID_COUR WHERE i.ID_USER = :userId");
        $query->execute(['userId' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function registerUserToCourse($userId, $courseId) {
        // Insert into inscription
        $query = $this->db->prepare("INSERT INTO inscription (ID_USER, ID_COUR) VALUES (:userId, :courseId)");
        $query->execute([
            'userId' => $userId,
            'courseId' => $courseId
        ]);
    
        // Get course tags
        $courseTagsQuery = $this->db->prepare("SELECT TAGS FROM cours WHERE ID = :courseId");
        $courseTagsQuery->execute(['courseId' => $courseId]);
        $courseTags = $courseTagsQuery->fetch(PDO::FETCH_ASSOC)['TAGS'];
    
        // Get user tags
        $userTagsQuery = $this->db->prepare("SELECT TAGS FROM users WHERE ID = :userId");
        $userTagsQuery->execute(['userId' => $userId]);
        $userTags = $userTagsQuery->fetch(PDO::FETCH_ASSOC)['TAGS'];
    
        // Combine user tags and course tags
        $combinedTags = $userTags . ($userTags ? ',' : '') . $courseTags;
    
        // Remove duplicate tags
        $updatedTagsArray = array_unique(explode(',', $combinedTags));
        $updatedTags = implode(',', $updatedTagsArray);
    
        // Update user tags
        $updateUserTagsQuery = $this->db->prepare("UPDATE users SET TAGS = :updatedTags WHERE ID = :userId");
        $updateUserTagsQuery->execute([
            'userId' => $userId,
            'updatedTags' => $updatedTags
        ]);
    
        return $this->db->lastInsertId();
    }
    
    public function leaveCourse($userId, $courseId) {
        $query = $this->db->prepare("DELETE FROM inscription WHERE ID_USER = :userId AND ID_COUR = :courseId");
        $query->execute([
            'userId' => $userId,
            'courseId' => $courseId
        ]);
    
        return $query->rowCount();
    }
    public function suggestCoursesByTags($userId) {
        $query = $this->db->prepare("
            SELECT DISTINCT c.* FROM cours c
            JOIN inscription i ON c.ID = i.ID_COUR
            WHERE i.ID_USER = :userId AND 
            (FIND_IN_SET(c.TAGS, (SELECT GROUP_CONCAT(TAGS) FROM users WHERE ID = :userId)) > 0)
        ");
        $query->execute(['userId' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function suggestCoursesByTags2($userId) {
        $userQuery = $this->db->prepare("SELECT TAGS FROM users WHERE ID = :userId");
        $userQuery->execute(['userId' => $userId]);
        $userTags = $userQuery->fetch(PDO::FETCH_ASSOC)['TAGS'];
    
        $userTagsArray = explode(',', $userTags);
    
        $likeConditions = implode(' OR ', array_map(function ($tag) {
            return "c.TAGS LIKE '%$tag%'";
        }, $userTagsArray));
    
        
        $query = $this->db->prepare("SELECT DISTINCT c.* FROM cours c 
                                     WHERE ($likeConditions) AND c.ID NOT IN (
                                         SELECT ID_COUR FROM inscription WHERE ID_USER = :userId
                                     )");
    
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->execute();
    
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
        
        if(empty($result)) {
            $randomQuery = $this->db->prepare("SELECT * FROM cours c WHERE c.ID NOT IN (
                                                SELECT ID_COUR FROM inscription WHERE ID_USER = :userId
                                            ) ORDER BY RAND() LIMIT 5");
            $randomQuery->bindParam(':userId', $userId, PDO::PARAM_INT);
            $randomQuery->execute();
            $result = $randomQuery->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return $result;
    }


    public function getAllUsers() {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
    
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getUserNoteByCourseId($userId, $course_id) {
        $query = 'SELECT note.NOTE FROM note WHERE note.ID_USER = :user_id AND note.ID_QCM = :course_id ORDER BY note.DATE DESC LIMIT 1';
        $stmt = $this->db->prepare($query);
    
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
    
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
            
}
