<?php
require_once 'C:/Users/utilisateur/Documents/universite/L3/S6/DAW/Projet/DAW_projet/tests-integration/config/db.php';

require_once 'C:/Users/utilisateur/Documents/universite/L3/S6/DAW/Projet/DAW_projet/tests-integration/models/Post.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
                header("Location: ../view/PHP/connexion.php");
            }
        }
        if (isset($_POST['paction'])) {
            $action = $_POST['paction'];
            echo $action;
            if (method_exists($this, $action . 'Action')) {
                $this->{$action . 'Action'}();
            } else {
                $_SESSION['error'] = "Invalid Action";
                header("Location: ../view/PHP/connexion.php");
            }
        }
    }

    public function createPostAction() {
        $userId = $_SESSION['user_id'];
        $title = $_POST['title'];
        $safe_title = htmlentities($title, ENT_QUOTES, 'UTF-8');
        $content = $_POST['content'];
        $safe_content = htmlentities($content, ENT_QUOTES, 'UTF-8');
        $this->postModel->createPost($userId, $safe_title, $safe_content);
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
        $this->postModel->markPostAsResolved($postId);
        $previousPage = $_SERVER['HTTP_REFERER'];
        return header('Location: ' . $previousPage);

    }

    public function searchPostsAction() {
        $searchTerm = $_GET['search'];
        $result =  $this->postModel->searchPosts($searchTerm);
    
        $_SESSION['search_result'] = $result;
    
        header("Location: ../view/PHP/forum.php");
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
        $safe_content = htmlentities($content, ENT_QUOTES, 'UTF-8');
    
        $this->postModel->createResponse($userId, $postId, $safe_content);
        $previousPage = $_SERVER['HTTP_REFERER'];
        return header('Location: ' . $previousPage);
    }

    public function getResponsesByPostId($postId) {
        return $this->postModel->getResponsesByPostId($postId);
    }

    public function viewPostWithResponses($postId) {

        $post = $this->postModel->getPostById($postId);
        $responses = $this->postModel->getResponsesByPostId($postId);
    
        return [
            'post' => $post,
            'responses' => $responses
        ];
    }

    //getPostById
    public function getPostByIdAction($post_id) {
        return $this->postModel->getPostById($post_id);
    }


}


?>
