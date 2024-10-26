<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Création chapitre - Mon Site de Formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-creation.css">
</head>
<body>
    <?php 
        require_once 'header.php';
        require_once '../../controllers/CourseController.php';
        if($loggedInUser['ROLE'] != 1){
            header('Location: index.php');
        }
        ob_end_flush();
        $courseController = new CourseController($db);
        $currentCourse = $courseController->getCourseById($_GET['course_id']);
    ?>
  <h1>Créer un chapitre</h1>
  <p>Ajoutez un nouveau chapitre pour le cours : <?php echo $currentCourse['NAME']; ?></p>
  </header>
  <main>
    <section>
        <form action="../../controllers/ChapterController.php?chaction=addChapter" method="POST" enctype="multipart/form-data">
            <div class="new-chapitre">
                <div class="input-group">
                    <label for="chapter_number">Numero chapitre :</label>
                    <input type="number" id="chapter_number" name="chapter_number" min="1" max="99" required>
                </div>
                <div class="input-group">
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="url_video">Video :</label>
                    <input type="file" id="url_video" name="url_video" accept=".mp4" required>
                </div>
                <div class="input-group">
                    <label for="url_pdf">PDF :</label>
                    <input type="file" id="url_pdf" name="url_pdf" accept=".pdf" required>
                </div>
                <div class="input-group">
                    <label for="thumbnail">Thumbnail :</label>
                    <input type="file" id="thumbnail" name="thumbnail" accept=".jpg , .jpeg , .png" >
                </div>
                <input type="hidden" name="courseId" value="<?php echo $currentCourse['ID']; ?>">
                <button type="submit">Valider</button>
            </div>
        </form>
    </section>
</main>
<footer>
  <p>Tout droit réservé © 2023 Mon site de formation</p>
</footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
<script src="../JS/script-checking.js"></script>
</html>