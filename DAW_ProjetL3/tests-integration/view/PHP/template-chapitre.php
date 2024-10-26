<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Nom chapitre - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-template-chapitre.css">
</head>
<body>
    <?php 
        require_once "header.php" ; 
        require_once "../../controllers/CourseController.php";
        require_once "../../controllers/ChapterController.php";
        $courseController = new CourseController($db);
        $chapterController = new ChapterController($db);
        $currentChapter = $chapterController->getChapterById($_GET['chapter_id']);
    ?>
        <h1><?php echo 'Chapitre ' . $currentChapter['NUMERO_CHAP'] . ' : ' . $currentChapter['NAME']; ?></h1>
    </header>
    <main>
        <section>
            <h2>Cours vidéo</h2>
            <iframe class="media" src="<?php echo "../" . $currentChapter['URL_VIDEO']; ?>" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </section>
        <section>
            <h2>Cours PDF</h2>
            <embed class="media" src="<?php echo "../" . $currentChapter['URL_PDF']; ?>" type='application/pdf'/>
        </section>
        <!-- <section>
            <a href="<?php $currentChapter['']?>">Chapitre suivant</a>
        </section> -->
    </main>
    <footer>
        <p>Tout droit réservé © 2023 Mon site de formation</p>
    </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
</html>