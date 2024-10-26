<?php
require_once '../config/db.php';

require_once '../models/Post.php';


// REMOVE LATER
session_start();
$postController = new PostController($db);

class PostController {
    private $postModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->postModel = new Post($db);
        if (isset($_GET['paction'])) {
            $action = $_GET['paction'];
            echo $action;
            if (method_exists($this, $action . 'Action')) {
                $this->{$action . 'Action'}();
            } else {
                $_SESSION['error'] = "Invalid Action";
                header("Location: ../views/index.php");
            }
        }
        if (isset($_POST['paction'])) {
            $action = $_POST['paction'];
            echo $action;
            if (method_exists($this, $action . 'Action')) {
                $this->{$action . 'Action'}();
            } else {
                $_SESSION['error'] = "Invalid Action";
                header("Location: ../views/index.php");
            }
        }
    }

    public function createPostAction($title, $content) {
        $userId = $_SESSION['user_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $this->postModel->createPost($userId, $title, $content);
        $previousPage = $_SERVER['HTTP_REFERER'];
        return header('Location: ' . $previousPage);
    }

    /* Deprecated
    public function createResponseAction($userId, $postId, $content) {
        return $this->postModel->createResponse($userId, $postId, $content);
    }
    */

    public function markPostAsResolvedAction() {
        $postId = $_POST['post_id'];
        return $this->postModel->markPostAsResolved($postId);
    }

    public function searchPostsAction() {
        $searchTerm = $_GET['search'];
        $result =  $this->postModel->searchPosts($searchTerm);
        return $result;
    }

    
    public function deletePostAction() {
        $postId = $_POST['post_id'];
    
        $this->postModel->deletePost($postId);
        $previousPage = $_SERVER['HTTP_REFERER'];
        return header('Location: ' . $previousPage);
    }

    public function createResponseAction() {
        $userId = $_SESSION['user_id'];
        $postId = $_POST['post_id'];
        $content = $_POST['content'];
    
        $this->postModel->createResponse($userId, $postId, $content);
        $previousPage = $_SERVER['HTTP_REFERER'];
        return header('Location: ' . $previousPage);
    }

    public function viewResponsesAction() {
        if(!isset($post)) {
            $postId = $_GET['post_id'];
        }

        $responses = $this->postModel->getResponsesByPostId($postId);
    
        return  $responses;
    }

    public function viewPostWithResponses($postId) {

        $post = $this->postModel->getPostById($postId);
        $responses = $this->postModel->getResponsesByPostId($postId);
    
        return [
            'post' => $post,
            'responses' => $responses
        ];
    }

}
