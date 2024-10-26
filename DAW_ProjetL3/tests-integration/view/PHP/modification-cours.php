<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modification cours - Mon Site de Formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-creation.css">
  <link rel="stylesheet" href="../CSS/style-modification-cours.css">
</head>
<body>
    <?php 
        require_once 'header.php';
        require_once '../../controllers/ChapterController.php';
        require_once '../../controllers/CourseController.php';
        if($loggedInUser['ROLE'] != 1){
            header('Location: index.php');
        }
        ob_end_flush();
        $courseController = new CourseController($db);
        $chapterController = new ChapterController($db);
        $currentCourse = $courseController->getCourseById($_GET['course_id']);
    ?>
  <h1>Modifier un cours</h1>
  <p>Modification des données du cours : <?php echo $currentCourse['NAME']; ?></p>
  </header>
  <main>
    <div id="left">
      <section>
        <form action="../../controllers/CourseController.php?caction=updateCourse" method="POST" enctype="multipart/form-data">
          <div class="input-group">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" value="<?php echo $currentCourse['NAME']; ?>" required>
          </div>
          <div class="input-group">
            <label for="tags">Tags :</label>
            <input type="text" id="tags" name="tags" placeholder="#tag1,#tag2,..." value="<?php echo $currentCourse['TAGS']; ?>" required>
          </div>
          <div class="input-group">
              <label for="upload-qcm">QCM (.xml) :</label>
              <input type="file" id="upload-qcm" name="qcm" accept=".xml">
          </div>
          <div class="input-group">
            <label for="thumbnail-cours">Thumbnail :</label>
            <input type="file" id="thumbnail" name="thumbnail" accept=".jpg , .jpeg , .png">
          </div>
          <input type="hidden" name="courseId" value="<?php echo $currentCourse['ID']; ?>">
          <button type="submit">Valider</button>
        </form>
        <form href="../../controllers/CourseController.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
              <input type="hidden" name="caction" value="deleteCourse">
              <input type="hidden" name="course_id" value="<?php echo $currentCourse['ID']; ?>">
              <button type="submit">- Supprimer</button>
            </div>
        </form>
      </section>
      <section>
        <a class="add-chapitre" href="creation-chapitre.php?course_id=<?php echo $currentCourse['ID']; ?>">+ Ajouter un chapitre</a>
      </section>
    </div>
    <div id="right">
      <section>
        <h2>Cliquez pour modifier un chapitre</h2>
          <?php
            $chapters = $chapterController->getChaptersByCourseId($currentCourse['ID']);
            foreach($chapters as $chapter):
          ?>
            <a class="chapitre" href="modification-chapitre.php?chapter_id=<?= $chapter['ID'] ?>">
              <h2>Chapitre <?= $chapter['NUMERO_CHAP'] ?> : </h2>
              <p><?= $chapter['NAME'] ?></p>
            </a>
          <?php endforeach; ?>
      </section>
    </div>
  </main>
  <footer>
    <p>Tout droit réservé © 2023 Mon site de formation</p>
  </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
</html>
