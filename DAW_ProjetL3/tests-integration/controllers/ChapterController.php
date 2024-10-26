<?php
require_once 'C:/Users/utilisateur/Documents/universite/L3/S6/DAW/Projet/DAW_projet/tests-integration/config/db.php';

require_once 'C:/Users/utilisateur/Documents/universite/L3/S6/DAW/Projet/DAW_projet/tests-integration/models/Chapter.php';


$chapterController = new ChapterController($db);

class ChapterController {
    private $chapterModel;

    public function __construct($db) {
        $this->chapterModel = new Chapter($db);
        if (isset($_GET['chaction'])) {
            $action = $_GET['chaction'];
            echo $action;
            if (method_exists($this, $action . 'Action')) {
                $this->{$action . 'Action'}();
            } else {
                $_SESSION['error'] = "Invalid Action";
                header("Location: ../view/PHP/connexion.php");
            }
        }
        if (isset($_POST['chaction'])) {
            $action = $_POST['chaction'];
            echo $action;
            if (method_exists($this, $action . 'Action')) {
                $this->{$action . 'Action'}();
            } else {
                $_SESSION['error'] = "Invalid Action";
                header("Location: ../view/PHP/connexion.php");
            }
        }
    }

    public function getAllChapters() {
        return $this->chapterModel->getAllChapters();
    }

    public function getChapterById($id) {
        return $this->chapterModel->getChapterById($id);
    }

    public function getChaptersByCourseId($course_id) {
        return $this->chapterModel->getChaptersByCourseId($course_id);
    }

    public function addChapter($course_id, $name, $url_pdf, $url_video, $chapter_number, $thumbnail) {
        return $this->chapterModel->createChapter($course_id, $name, $url_pdf, $url_video, $chapter_number, $thumbnail);
    }

    public function updateChapterAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $chapter_id = $_POST['chapterId'];
            $name = $_POST['name'];
            $chapter_number = $_POST['chapter_number'];

            $pdf_file = $_FILES['url_pdf'];
            $video_file = $_FILES['url_video'];
            $thumbnail_file = $_FILES['thumbnail'];

            $chapter = $this->chapterModel->getChapterById($chapter_id);
            $url_pdf = $chapter['URL_PDF'];
            $url_video = $chapter['URL_VIDEO'];
            $thumbnail_base64 = $chapter['THUMBNAIL'];

            if ($pdf_file['size'] > 0) {
                // A new PDF file is uploaded, update the URL
                $pdf_filename = checkFileHash('../uploads/pdfs/',$_FILES["url_pdf"]["tmp_name"]);
                if (!$pdf_filename) {
                    $pdf_filename = uniqid() . '_' . basename($_FILES["url_pdf"]["name"]);
                    move_uploaded_file($_FILES["url_pdf"]["tmp_name"], $pdf_filename);
                }
                $url_pdf = $pdf_filename;
            }

            if ($video_file['size'] > 0) {
                // A new video file is uploaded, update the URL
                $video_filename = checkFileHash('../uploads/videos/',$_FILES["url_video"]["tmp_name"]);
                if (!$video_filename) {
                    $video_filename = uniqid() . '_' . basename($_FILES["url_video"]["name"]);
                    move_uploaded_file($_FILES["url_video"]["tmp_name"], $video_filename);
                }
                $url_video = $video_filename;
            }
            $thumbnail_base64 = "";
            if ($thumbnail_file['size'] > 0) {
                // A new thumbnail file is uploaded, update the base64 encoded thumbnail
                $thumbnail = file_get_contents($thumbnail_file['tmp_name']);
                $thumbnail_base64 = base64_encode($thumbnail);
            }

            $this->chapterModel->updateChapter($chapter_id, $name, $url_pdf, $url_video, $chapter_number, $thumbnail_base64);

            header("Location: ../view/PHP/template-chapitre.php?chapter_id=$chapter_id");
        }
    }


    public function deleteChapter($id) {
        return $this->chapterModel->deleteChapter($id);
    }

    public function deleteChapterAction() {
        $chapterId = $_POST['chapter_id'];
        $course_id = $_POST['course_id'];
    
        $this->chapterModel->deleteChapter($chapterId);
            
        $previousPage = $_SERVER['HTTP_REFERER'];
        return header('Location: modification-cours.php?course_id=' . $course_id);
    }
    
    public function addChapterAction() {
        ob_start();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $course_id = $_POST['courseId'];
            $name = $_POST['name'];
            $chapter_number = $_POST['chapter_number'];
    
            $pdf_target_dir = "../uploads/pdfs/";
            $video_target_dir = "../uploads/videos/";
    
            $pdf_random_name = uniqid() . '_' . basename($_FILES["url_pdf"]["name"]);
            $video_random_name = uniqid() . '_' . basename($_FILES["url_video"]["name"]);
    
            $pdf_target_file = $pdf_target_dir . $pdf_random_name;
            $video_target_file = $video_target_dir . $video_random_name;
    
            $existing_pdf_file = checkFileHash($pdf_target_dir, $_FILES["url_pdf"]["tmp_name"]);
            $existing_video_file = checkFileHash($video_target_dir, $_FILES["url_video"]["tmp_name"]);
    
            if ($existing_pdf_file) {
                $pdf_target_file = $existing_pdf_file;
            } else {
                move_uploaded_file($_FILES["url_pdf"]["tmp_name"], $pdf_target_file);
            }
    
            if ($existing_video_file) {
                $video_target_file = $existing_video_file;
            } else {
                move_uploaded_file($_FILES["url_video"]["tmp_name"], $video_target_file);
            }
    
            $thumbnail_base64 = "";
            if (isset($_FILES['thumbnail']['tmp_name']) && !empty($_FILES['thumbnail']['tmp_name'])) {
                $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
                $thumbnail_base64 = base64_encode($thumbnail);
            }
    
            $this->chapterModel->createChapter($course_id, $name, $pdf_target_file, $video_target_file, $chapter_number, $thumbnail_base64);
            
            header("Location: ../view/PHP/modification-cours.php?course_id=$course_id");
            ob_end_flush();
        }
    }
    



}
