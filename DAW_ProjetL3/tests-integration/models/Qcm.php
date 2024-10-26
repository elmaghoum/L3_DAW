<?php
class Qcm {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllQcms() {
        $query = $this->db->prepare("SELECT * FROM qcm");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQcmById($id) {
        $query = $this->db->prepare("SELECT * FROM qcm WHERE ID = :id");
        $query->execute(['id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getQcmByCourseId($course_id) {
        $query = $this->db->prepare("SELECT * FROM qcm WHERE ID_COURS = :course_id");
        $query->execute(['course_id' => $course_id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getQCMIdByCourseId($courseId) {
        $query = $this->db->prepare("SELECT ID FROM qcm WHERE ID_COURS = :courseId");
        $query->execute(['courseId' => $courseId]);
    
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['ID'] : null;
    }
    

    public function createQcm($course_id, $url) {
        $query = $this->db->prepare("INSERT INTO qcm (ID_COURS, URL) VALUES (:course_id, :url)");
        $query->execute([
            'course_id' => $course_id,
            'url' => $url
        ]);

        return $this->db->lastInsertId();
    }

    public function updateQcm($id, $url) {
        $query = $this->db->prepare("UPDATE qcm SET URL = :url WHERE ID = :id");
        $query->execute([
            'id' => $id,
            'url' => $url
        ]);

        return $query->rowCount();
    }

    public function deleteQcm($id) {
        $query = $this->db->prepare("DELETE FROM qcm WHERE ID = :id");
        $query->execute(['id' => $id]);

        return $query->rowCount();
    }
    public function getQcmContent($url) {
        $content = file_get_contents($url);
        $xml = simplexml_load_string($content);
    
        return $xml;
    }

    public function saveUserNote($course_id, $userId, $note) {

        $query = 'INSERT INTO note (ID_QCM, ID_USER, NOTE, DATE) VALUES (:course_id, :user_id, :note, NOW())';
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':course_id', $course_id);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':note', $note);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
