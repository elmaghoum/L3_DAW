<?php
require_once '../models/Enrollment.php';

class EnrollmentController {
    private $enrollmentModel;

    public function __construct($db) {
        $this->enrollmentModel = new Enrollment($db);
    }

    public function getAllEnrollments() {
        return $this->enrollmentModel->fetchAllEnrollments();
    }

    public function getEnrollmentById($id) {
        return $this->enrollmentModel->fetchEnrollmentById($id);
    }

    public function getEnrollmentsByUserId($user_id) {
        return $this->enrollmentModel->fetchEnrollmentsByUserId($user_id);
    }

    public function getEnrollmentsByCourseId($course_id) {
        return $this->enrollmentModel->fetchEnrollmentsByCourseId($course_id);
    }

    public function addEnrollment($course_id, $user_id, $chapter) {
        return $this->enrollmentModel->createEnrollment($course_id, $user_id, $chapter);
    }

    public function updateEnrollment($id, $course_id, $user_id, $chapter) {
        return $this->enrollmentModel->editEnrollment($id, $course_id, $user_id, $chapter);
    }

    public function deleteEnrollment($id) {
        return $this->enrollmentModel->removeEnrollment($id);
    }
}
