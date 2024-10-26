<?php
class Chapter {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllChapters() {
        $query = $this->db->prepare("SELECT * FROM chapitre");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChapterById($id) {
        $query = $this->db->prepare("SELECT * FROM chapitre WHERE ID = :id");
        $query->execute(['id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getChaptersByCourseId($course_id) {
        $query = $this->db->prepare("SELECT * FROM chapitre WHERE ID_COURS = :course_id");
        $query->execute(['course_id' => $course_id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createChapter($course_id, $name, $url_pdf, $url_video, $numero_chap, $thumbnail) {
        $query = $this->db->prepare("INSERT INTO chapitre (ID_COURS, NAME, URL_PDF, URL_VIDEO, NUMERO_CHAP, THUMBNAIL) VALUES (:course_id, :name, :url_pdf, :url_video, :numero_chap, :thumbnail)");
        $query->execute([
            'course_id' => $course_id,
            'name' => $name,
            'url_pdf' => $url_pdf,
            'url_video' => $url_video,
            'numero_chap' => $numero_chap,
            'thumbnail' => $thumbnail
        ]);

        return $this->db->lastInsertId();
    }

    public function updateChapter($id, $name, $url_pdf, $url_video, $numero_chap, $thumbnail)
    {
        if (!empty($thumbnail)) {
            $query = $this->db->prepare("UPDATE chapitre SET NAME = :name, URL_PDF = :url_pdf, URL_VIDEO = :url_video, NUMERO_CHAP = :numero_chap, THUMBNAIL = :thumbnail WHERE ID = :id");
            $query->execute([
                'id' => $id,
                'name' => $name,
                'url_pdf' => $url_pdf,
                'url_video' => $url_video,
                'numero_chap' => $numero_chap,
                'thumbnail' => $thumbnail
            ]);
        } else {
            $query = $this->db->prepare("UPDATE chapitre SET NAME = :name, URL_PDF = :url_pdf, URL_VIDEO = :url_video, NUMERO_CHAP = :numero_chap WHERE ID = :id");
            $query->execute([
                'id' => $id,
                'name' => $name,
                'url_pdf' => $url_pdf,
                'url_video' => $url_video,
                'numero_chap' => $numero_chap
            ]);
        }
    
        return $query->rowCount();
    }
    

    public function deleteChapter($id) {
        $query = $this->db->prepare("DELETE FROM chapitre WHERE ID = :id");
        $query->execute(['id' => $id]);

        return $query->rowCount();
    }
}
