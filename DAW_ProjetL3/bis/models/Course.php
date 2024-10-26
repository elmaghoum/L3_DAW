<?php
class Course {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllCourses() {
        $query = $this->db->prepare("SELECT * FROM cours");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourseById($id) {
        $query = $this->db->prepare("SELECT * FROM cours WHERE ID = :id");
        $query->execute(['id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function createCourse($name,$thumbnail,$tags) {
        $query = $this->db->prepare("INSERT INTO cours (NAME,THUMBNAIL,TAGS) VALUES (:name, :thumbnail, :tags)");
        $query->execute([
        'name' => $name,
        'thumbnail' => $thumbnail,
        'tags' => $tags
        ]);



        return $this->db->lastInsertId();
    }

    public function updateCourse($id, $name, $tags, $thumbnail) {
        if (!empty($thumbnail)) {
            $query = $this->db->prepare("UPDATE cours SET NAME = :name, THUMBNAIL = :thumbnail, TAGS = :tags  WHERE ID = :id");
            $query->execute([
                'id' => $id,
                'name' => $name,
                'thumbnail' => $thumbnail,
                'tags' => $tags
            ]);
        } else {
            $query = $this->db->prepare("UPDATE cours SET NAME = :name, TAGS = :tags WHERE ID = :id");
            $query->execute([
                'id' => $id,
                'name' => $name,
                'tags' => $tags
            ]);
        }
    
        return $query->rowCount();
    }
    

    public function deleteCourse($id) {
        $query = $this->db->prepare("DELETE FROM cours WHERE ID = :id");
        $query->execute(['id' => $id]);

        return $query->rowCount();
    }
    public function searchCoursesByTitleAndContent($searchQuery) {
        $query = $this->db->prepare("SELECT * FROM cours WHERE NAME LIKE :searchQuery OR TAGS LIKE :searchQuery");
        $query->execute(['searchQuery' => '%' . $searchQuery . '%']);
    
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
