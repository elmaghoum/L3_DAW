
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Mon profil - Mon Site de Formation</title>
    <link rel="stylesheet" href="../CSS/style-profil.css">
    <link rel="stylesheet" href="../CSS/style-header.css">
  </head>
  <body>
    <?php 
      require_once 'header.php';
      require_once '../../controllers/QcmController.php';
      $qcmController = new QcmController($db);
    ?>
    <h1>Mon profil</h1>
    <p>Retrouvez ici vos informations personnelles ainsi que votre avancement sur la plateforme Mon site de formation</p>
    </header>
    <main>
      <section class="user-info">
        <h2>Mes informations personnelles</h2>
        <div id="infos">
          <img src="data:image/png;base64, <?php echo $pp; ?>" alt="pp" width="100px">
          <div id="infos2">
            <p><span class="label">Nom :</span><span class="info"><?php echo $loggedInUser['NAME'];?></span></p>
            <p><span class="label">Prénom :</span><span class="info"><?php echo $loggedInUser['FIRSTNAME'];?></span></p>
            <p><span class="label">Mail :</span><span class="info"><?php echo $loggedInUser['EMAIL'];?></span></p>
          </div>
        </div>
      </section>
      <section class="user-cours">
        <h2>Mes cours suivis</h2>
        <ul>
          <?php 
            $courses = $userController->getCoursesByUserIdAction($loggedInUser['ID']);
            foreach ($courses as $course):
          ?>
            <li><a href="template-cours.php?course_id=<?= $course['ID'] ?>"><img src="data:image/png;base64,<?= $course['THUMBNAIL'] ?>" alt="<?= $course['NAME'] ?>"></a></li>
          <?php endforeach; ?>
        </ul>
      </section>
      <section class="user-stats">
        <h2>Mes statistiques</h2>
        <ul>
          <?php 
            $courses = $userController->getCoursesByUserIdAction($loggedInUser['ID']);
            foreach ($courses as $course):
              $total = $qcmController->getTotalQuestionsByCourseId($course['ID']);
              $note = $userController->getUserNote($loggedInUser['ID'], $course['ID']);
              if (isset($note['NOTE'])) :
          ?>
          <li><p><span class="stats-cours"><?= $course['NAME'] ?></span><span class="note"><?= $note['NOTE'] ?>/<?= $total ?></span></p></li>
          <?php else: ?>
          <li><p><span class="stats-cours"><?= $course['NAME'] ?></span><span class="note">ø</span></p></li>
          <?php endif; ?>
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