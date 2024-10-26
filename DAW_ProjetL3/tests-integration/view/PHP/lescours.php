<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Cours - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-lescours.css">
</head>
<body>
  <?php 
    require_once "header.php" ; 
    require_once "../../controllers/CourseController.php";
    $courseController = new CourseController($db);
  ?>
  <h1>Cours</h1>
  <p>Retrouvez ici tout les cours que nous proposons sur la plateforme Mon site de formation.<?php if($loggedInUser['ROLE']==1)echo " Cliquez pour modifier un cours.";?></p>
  </header>
  <main>
    <section>
        <ul class="thumbnail">
          <?php 
              $courses = $courseController->getAllCoursesAction();
              foreach ($courses as $course):
          ?>
            <li><a href="<?php if($loggedInUser['ROLE']==1)echo "modification-cours"; else echo "template-cours"?>.php?course_id=<?= $course['ID'] ?>"><img src="data:image/png;base64,<?= $course['THUMBNAIL'] ?>" alt="<?= $course['NAME'] ?>"></a></li>
          <?php endforeach; ?>
        </ul>
      </section>
  </main>
  <footer>
    <p>Tout droit réservé © 2023 Mon site de formation</p>
  </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
</html>


