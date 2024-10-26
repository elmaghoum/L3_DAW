<?php
require_once '../config/db.php';

require_once '../models/Course.php';
require_once '../models/Qcm.php';


function checkFileHash($target_dir, $uploaded_file_tmp_name) {
    $uploaded_file_hash = hash_file('sha256', $uploaded_file_tmp_name);

    $files = glob($target_dir . '*.*');
    foreach ($files as $file) {
        $file_hash = hash_file('sha256', $file);
        if ($uploaded_file_hash === $file_hash) {
            return $file;
        }
    }

    return false;
}

$CourseController = new CourseController($db);
class CourseController {
    private $courseModel;
    private $qcmModel;

    public function __construct($db) {
        $this->courseModel = new Course($db);
        $this->qcmModel = new Qcm($db);
        if (isset($_GET['caction'])) {
            $action = $_GET['caction'];
            echo $action;
            if (method_exists($this, $action . 'Action')) {
                $this->{$action . 'Action'}();
            } else {
                $_SESSION['error'] = "Invalid Action";
                header("Location: ../views/login.php");
            }
        }
        if (isset($_POST['caction'])) {
            $action = $_POST['caction'];
            echo $action;
            if (method_exists($this, $action . 'Action')) {
                $this->{$action . 'Action'}();
            } else {
                $_SESSION['error'] = "Invalid Action";
                header("Location: ../views/login.php");
            }
        }
    }

    public function getAllCoursesAction() {
        return $this->courseModel->getAllCourses();
    }

    public function getCourseById($id) {
        return $this->courseModel->getCourseById($id);
    }

    public function addCourse($name) {
        return $this->courseModel->createCourse($name);
    }

    public function updateCourse($id, $name,$tags,$thumbnail) {
        return $this->courseModel->updateCourse($id, $name,$tags,$thumbnail);
    }

    public function deleteCourse($id) {
        return $this->courseModel->deleteCourse($id);
    }
    public function deleteCourseAction() {
        $courseId = $_POST['course_id'];
    
        $this->courseModel->deleteCourse($courseId);
            
        $previousPage = $_SERVER['HTTP_REFERER'];
        return header('Location: ' . $previousPage);
    }
    public function searchCoursesByTitleAndContentAction() {
        $searchTerm = $_GET['search'];
        return $this->courseModel->searchCoursesByTitleAndContent($searchTerm);
    }
    
    public function createCourseAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $tags = $_POST['tags'];
    
            if ($_FILES['thumbnail']['size'] > 0) {
                $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
                $thumbnail_base64 = base64_encode($thumbnail);
            } else {
                $thumbnail_base64 = "";
            }
    
            $course_id = $this->courseModel->createCourse($name, $thumbnail_base64, $tags);
    
            if ($_FILES['qcm']['size'] > 0) {
                $qcm_target_dir = "../uploads/qcm/";
                $qcm_random_name = uniqid() . '_' . basename($_FILES["qcm"]["name"]);
                $qcm_target_file = $qcm_target_dir . $qcm_random_name;
    
                $existing_qcm_file = checkFileHash($qcm_target_dir, $_FILES["qcm"]["tmp_name"]);
    
                if ($existing_qcm_file) {
                    $qcm_target_file = $existing_qcm_file;
                } else {
                    move_uploaded_file($_FILES["qcm"]["tmp_name"], $qcm_target_file);
                }
    
                $this->qcmModel->createQcm($course_id, $qcm_target_file);
            }
    
            header("Location: ../views/test.php");
        }
    }
    

    public function updateCourseAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['courseId'];
            $name = $_POST['name'];
            $tags = $_POST['tags'];
    
            if ($_FILES['thumbnail']['size'] > 0) {
                $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
                $thumbnail_base64 = base64_encode($thumbnail);
            } else {
                $thumbnail_base64 = "";
            }

            if ($_FILES['qcm']['size'] > 0) {
                $qcm_target_dir = "../uploads/qcm/";
                $qcm_random_name = uniqid() . '_' . basename($_FILES["qcm"]["name"]);
                $qcm_target_file = $qcm_target_dir . $qcm_random_name;
    
                $existing_qcm_file = checkFileHash($qcm_target_dir, $_FILES["qcm"]["tmp_name"]);
    
                if ($existing_qcm_file) {
                    $qcm_target_file = $existing_qcm_file;
                } else {
                    move_uploaded_file($_FILES["qcm"]["tmp_name"], $qcm_target_file);
                }
                $qcm_id =  $this->createOrUpdateQCM($id, $qcm_target_file);
            }
    
            $this->courseModel->updateCourse($id, $name, $tags, $thumbnail_base64);
    
            header("Location: ../views/edit_course.php?courseId=" . $id);
        }
    }

    public function getQCMIdByCourseId($courseId) {
        return $this->qcmModel->getQCMIdByCourseId($courseId);
    }
    
    public function createOrUpdateQCM($courseId, $qcmUrl) {
        $qcmId = $this->getQCMIdByCourseId($courseId);
    
        if ($qcmId === null) {
            $this->qcmModel->createQcm($courseId, $qcmUrl);
        } else {
            $this->qcmModel->updateQcm($qcmId, $qcmUrl);
        }
    }
    
}