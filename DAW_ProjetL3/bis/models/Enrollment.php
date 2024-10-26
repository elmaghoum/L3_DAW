<?php
class Enrollment {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllEnrollments() {
        $query = $this->db->prepare("SELECT * FROM inscription");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnrollmentById($id) {
        $query = $this->db->prepare("SELECT * FROM inscription WHERE ID = :id");
        $query->execute(['id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getEnrollmentsByUserId($user_id) {
        $query = $this->db->prepare("SELECT * FROM inscription WHERE ID_USER = :user_id");
        $query->execute(['user_id' => $user_id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnrollmentsByCourseId($course_id) {
        $query = $this->db->prepare("SELECT * FROM inscription WHERE ID_COUR = :course_id");
        $query->execute(['course_id' => $course_id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createEnrollment($course_id, $user_id, $chap) {
        $query = $this->db->prepare("INSERT INTO inscription (ID_COUR, ID_USER, CHAP) VALUES (:course_id, :user_id, :chap)");
        $query->execute([
            'course_id' => $course_id,
            'user_id' => $user_id,
            'chap' => $chap
        ]);

        return $this->db->lastInsertId();
    }

    public function updateEnrollment($id, $course_id, $user_id, $chap) {
        $query = $this->db->prepare("UPDATE inscription SET ID_COUR = :course_id, ID_USER = :user_id, CHAP = :chap WHERE ID = :id");
        $query->execute([
            'id' => $id,
            'course_id' => $course_id,
            'user_id' => $user_id,
            'chap' => $chap
        ]);

        return $query->rowCount();
    }

    public function deleteEnrollment($id) {
        $query = $this->db->prepare("DELETE FROM inscription WHERE ID = :id");
        $query->execute(['id' => $id]);

        return $query->rowCount();
    }
}
