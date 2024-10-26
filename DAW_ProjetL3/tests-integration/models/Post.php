<?php
class Post {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function createPost($userId, $title, $content) {
        $query = $this->db->prepare("INSERT INTO post (ID_USER, TITLE, CONTENT, DATE) VALUES (:userId, :title, :content, NOW())");
        $query->execute([
            'userId' => $userId,
            'title' => $title,
            'content' => $content
        ]);

        return $this->db->lastInsertId();
    }

    public function createResponse($userId, $postId, $content) {
        $query = $this->db->prepare("INSERT INTO response (ID_USER, ID_POST, CONTENT, DATE) VALUES (:userId, :postId, :content, NOW())");
        $query->execute([
            'userId' => $userId,
            'postId' => $postId,
            'content' => $content
        ]);

        return $this->db->lastInsertId();
    }

    public function markPostAsResolved($postId) {
        $query = $this->db->prepare("UPDATE post SET RESOLVED = 1 WHERE ID = :postId");
        $query->execute(['postId' => $postId]);

        return $query->rowCount();
    }

    public function searchPosts($searchTerm) {
        $searchTerm = '%' . $searchTerm . '%';
        $query = $this->db->prepare("SELECT * FROM post WHERE TITLE LIKE :searchTerm OR CONTENT LIKE :searchTerm");
        $query->execute(['searchTerm' => $searchTerm]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getResponsesByPostId($postId) {
        $query = $this->db->prepare("SELECT * FROM response WHERE ID_POST = :postId");
        $query->execute(['postId' => $postId]);
    
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostById($postId) {
        $query = $this->db->prepare("SELECT * FROM post WHERE ID = :postId");
        $query->execute(['postId' => $postId]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    public function deletePost($postId) {
        $query = $this->db->prepare("DELETE FROM post WHERE ID = :postId");
        $query->execute(['postId' => $postId]);
    
        return $query->rowCount();
    }
}
