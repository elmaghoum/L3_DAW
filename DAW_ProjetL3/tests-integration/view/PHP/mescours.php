<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes cours - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-mescours.css">
</head>
<body>
  <?php
    require_once "header.php" ;
    require_once "../../controllers/CourseController.php";
    require_once "../../controllers/ChapterController.php";
    $courseController = new CourseController($db);
    $chapterController = new ChapterController($db);
  ?>
  <h1>Mes cours</h1>
  <p>Bienvenue sur la page de vos cours. Vous pouvez accéder à vos différents cours en cliquant sur les liens ci-dessous :</p>
  </header>
  <main>
    <?php 
      $courses = $userController->getCoursesByUserIdAction($loggedInUser['ID']);
      foreach ($courses as $course){
        $chapters = $chapterController->getChaptersByCourseId($course['ID']);
    ?>
    <section>
      <div class="container-lien-cours">
        <a href="template-cours.php?course_id=<?php echo $course['ID']; ?>" class="lien-cours">
          <h2><?php echo $course['NAME']; ?></h2>
        </a>
      </div>
        <ul>
          <?php foreach ($chapters as $chapter){ ?>
            <li><a href="template-chapitre.php?chapter_id=<?= $chapter['ID'] ?>"><img src="data:image/png;base64,<?= $chapter['THUMBNAIL'] ?>" alt="<?= $chapter['NAME'] ?>"></a></li>
          <?php } ?>
        </ul>
      </section>
      <?php } ?>
  </main>
  <footer>
    <p>Tout droit réservé © 2023 Mon site de formation</p>
  </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
</html>


