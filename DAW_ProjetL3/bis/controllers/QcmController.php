<?php
require_once '../config/db.php';

require_once '../models/Qcm.php';

session_start();
$QcmController = new QcmController($db);

class QcmController {
    private $qcmModel;

    public function __construct($db) {
        $this->qcmModel = new Qcm($db);
        if (isset($_GET['qaction'])) {
            $action = $_GET['qaction'];
            echo $action;
            if (method_exists($this, $action . 'Action')) {
                $this->{$action . 'Action'}();
            } else {
                $_SESSION['error'] = "Invalid Action";
                header("Location: ../views/login.php");
            }
        }
        if (isset($_POST['qaction'])) {
            $action = $_POST['qaction'];
            echo $action;
            if (method_exists($this, $action . 'Action')) {
                $this->{$action . 'Action'}();
            } else {
                $_SESSION['error'] = "Invalid Action";
                header("Location: ../views/login.php");
            }
        }
    }

    public function getAllQcms() {
        return $this->qcmModel->fetchAllQcms();
    }

    public function getQcmById($id) {
        return $this->qcmModel->fetchQcmById($id);
    }

    public function getQcmByCourseId($course_id) {
        return $this->qcmModel->getQcmByCourseId($course_id);
    }

    public function addQcm($course_id, $url) {
        return $this->qcmModel->createQcm($course_id, $url);
    }

    public function updateQcm($id, $course_id, $url) {
        return $this->qcmModel->editQcm($id, $course_id, $url);
    }

    public function deleteQcm($id) {
        return $this->qcmModel->removeQcm($id);
    }

    public function getQcmQuestions($url) {
        return $this->parseQcmQuestions($url);
    }

    public function parseQcmQuestions($url) {
        $xmlContent = file_get_contents($url);
        $xml = new SimpleXMLElement($xmlContent);
        $questions = [];
        
        foreach ($xml->question as $question) {
            $interrogation = (string) $question->interrogation;
            $propositions = [];
    
            foreach ($question->propostion->rep as $proposition) {
                $propositions[] = (string) $proposition;
            }
    
            $solution = (string) $question->solution;
    
            $questions[] = [
                'interrogation' => $interrogation,
                'propositions' => $propositions,
                'solution' => $solution
            ];
        }
    
        return $questions;
    }
    

    public function checkAnswersAndCount($post_data, $questions) {
        $correct_answers_count = 0;
    
        foreach ($post_data as $question_key => $user_answer_index) {
            if (preg_match('/question(\d+)/', $question_key, $matches)) {
                $question_index = (int) $matches[1] - 1; // Get the question index by extracting the digits from the key and subtracting 1
    
                if ($question_index >= 0 && isset($questions[$question_index])) {
                    $correct_answer_index = array_search($questions[$question_index]['solution'], $questions[$question_index]['propositions']);
    
                    if ($correct_answer_index !== false && $correct_answer_index == $user_answer_index - 1) {
                        $correct_answers_count++;
                    }
                }
            }
        }
    
        return $correct_answers_count;
    }
    public function submitAnswers($course_id, $post_data) {
        $questions = $this->getQcmQuestionsByCourseId($course_id);
        $correct_answers_count = $this->checkAnswersAndCount($post_data, $questions);
        return $correct_answers_count;
    }

    public function getQcmQuestionsByCourseId($course_id) {
        $qcm = $this->getQcmByCourseId($course_id);
    
        if ($qcm) {
            $xml_url = $qcm['URL'];
            return $this->getQcmQuestions($xml_url);
        }
    
        return null;
    }

    public function submitAnswersAction() {
        echo 'HERE';
        $course_id = $_POST['course_id'];
        $post_data = $_POST;

        $correct_answers_count = $this->submitAnswers($course_id, $post_data);
        $userId = $_SESSION['user_id'];

        $this->qcmModel->saveUserNote($course_id, $userId, $correct_answers_count);

        /*
        // You can store the result in a session variable, so you can display it on the redirected page.
        session_start();
        $_SESSION['correct_answers_count'] = $correct_answers_count;
        */
        $previousPage = $_SERVER['HTTP_REFERER'];
        return header('Location: ' . $previousPage);
    }

    public function getTotalQuestionsByCourseId($course_id) {
        $qcm = $this->getQcmByCourseId($course_id);
        $url = $qcm['URL'];
        $questions = $this->parseQcmQuestions($url);

        $interrogation_count = 0;
        foreach ($questions as $question) {
            if (isset($question['interrogation'])) {
                $interrogation_count++;
            }
        }

        return $interrogation_count;
    }

    
    
}
