<?php
require_once '../config/db.php';

require_once '../models/User.php';

session_start();
$userController = new UserController($db);

class UserController {
    private $userModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->userModel = new User($db);
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            echo $action;
            if (method_exists($this, $action . 'Action')) {
                $this->{$action . 'Action'}();
            } else {
                $_SESSION['error'] = "Invalid Action";
                header("Location: ../views/login.php");
            }
        }
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            echo $action;
            if (method_exists($this, $action . 'Action')) {
                $this->{$action . 'Action'}();
            } else {
                $_SESSION['error'] = "Invalid Action";
                header("Location: ../views/login.php");
            }
        }
    }

    public function getLoggedInUserData() {
        if (isset($_SESSION['user_id'])) {
            return $this->userModel->getUserById($_SESSION['user_id']);
        } else {
            $_SESSION['error'] = "Vous etes deconnecté";
            header("Location: ../views/login.php");

            exit();
        }
    }

    
    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $user = $this->userModel->getUserByEmail($email);
                
                if ($user && sha1($password) == $user['PASSWORD']) {
                    $_SESSION['user_id'] = $user['ID'];
                    $_SESSION['user_role'] = $user['ROLE'];
                
                    if ($user['ROLE'] == 0) {
                        header("Location: ../views/index.php");
                    } else {
                        header("Location: ../views/index.php");
                    }
                } else {
                    $_SESSION['error'] = "Invalid email or password.-";
                    header("Location: ../views/login.php");
                }
            }
        }
    }
    

    public function logoutAction() {
        session_destroy();
        header("Location: ../views/login.php");
    }
    /* DEPRECATED
    public function registerAction($name, $firstname, $email, $password, $role) {
        $hashedPassword = sha1($password);
        return $this->userModel->createUser($name, $firstname, $email, $hashedPassword, $role);
    }
    */

    public function registerAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
    
            if($_FILES['pp']['size'] > 0) {
                $pp = file_get_contents($_FILES['pp']['tmp_name']);
                $pp_base64 = base64_encode($pp);
            } else {
                $pp_base64 = "";
            }
    
            // Call the createUser method
            $this->userModel->createUser($name, $firstname, $email, $password, $role, $pp_base64, '');
            
            // Redirect to the login page
            header("Location: ../views/login.php");
        }
    }

    public function editProfileAction($id, $name, $firstname, $email) {
        return $this->userModel->updateUser($id, $name, $firstname, $email);
    }

    public function getCoursesByUserIdAction($userId) {
        return $this->userModel->getCoursesByUserId($userId);
    }
    public function registerUserToCourseAction()
    {
        $userId = $_SESSION['user_id'];
        $courseId = $_POST['courseId'];
        return $this->userModel->registerUserToCourse($userId, $courseId);
    }

    public function leaveCourseAction()
    {
        $userId = $_SESSION['user_id'];
        $courseId = $_POST['courseId'];
        return $this->userModel->leaveCourse($userId, $courseId);
    }

    public function suggestCoursesByTagsAction($userId) {
        return $this->userModel->suggestCoursesByTags($userId);
    }
    public function suggestCoursesByTagsAction2($userId) {
        return $this->userModel->suggestCoursesByTags2($userId);
    }
      
    public function updateUserAction() {
        $userId = $_POST['user_id'];
        $name = $_POST['name'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $pp = $_FILES['pp'];
        $tag = $_POST['tag'];


        if($_FILES['pp']['size'] > 0) {
            $pp = file_get_contents($_FILES['pp']['tmp_name']);
            $pp_base64 = base64_encode($pp);
        } else {
            $pp_base64 = "";
        }
    
        $this->userModel->updateUser($userId, $name, $firstname, $email, $password, $role, $pp_base64, $tag);
        
        
        $previousPage = $_SERVER['HTTP_REFERER'];
        return header('Location: ' . $previousPage);
    }

    public function listUsersAction() {
        return $this->userModel->getAllUsers();
    }
    
    public function deleteUserAction() {
        $userId = $_POST['user_id'];
    
        $this->userModel->deleteUser($userId);

        $previousPage = $_SERVER['HTTP_REFERER'];
        return header('Location: ' . $previousPage);
    }
    // UserController.php

    public function getUserByIdAction($userId) {
        return $this->userModel->getUserById($userId);
    }

    
    public function getUserNote($userId, $course_id) {
        return $this->userModel->getUserNoteByCourseId($userId, $course_id);
    }

}
