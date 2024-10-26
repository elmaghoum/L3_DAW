<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-index.css">
</head>
<body>
    <?php require_once "header.php" ; 
        if($loggedInUser['ROLE'] != 0){
            header('Location: index-admin.php');
        }
        ob_end_flush();
    ?>
        <h1>Accueil</h1>
        <p>Bienvenue sur Mon site de formation ! Commencez un cours, évaluez vous ou allez sur le forum</p>
    </header>
    <main>
        <div id="left">
            <section id="section-recommandation">
                <h2><a href="lescours.php" class="lien-h2">Recommandation</a></h2>
                <ul class="thumbnail">
                    <?php 
                        $courses = $userController->suggestCoursesByTagsAction2($loggedInUser['ID']);
                        
                        for($i = count($courses)-1; ($i >= count($courses)-10) && ($i >= 0); $i--):
                            $course = $courses[$i];
                    ?>
                    <li><a href="template-cours.php?course_id=<?= $course['ID'] ?>"><img src="data:image/png;base64,<?= $course['THUMBNAIL'] ?>" alt="<?= $course['NAME'] ?>"></a></li>
                    <?php endfor; ?>
                </ul>
            </section>
        </div>
        <div id="right">
            <section id="section-mes-cours">
                <h2><a href="mescours.php" class="lien-h2">Mes cours</a></h2>
                <ul class="thumbnail">
                <?php 
                        $courses = $userController->getCoursesByUserIdAction($loggedInUser['ID']);
                        
                        for($i = count($courses)-1; ($i >= count($courses)-10) && ($i >= 0); $i--):
                            $course = $courses[$i];
                    ?>
                    <li><a href="template-cours.php?course_id=<?= $course['ID'] ?>"><img src="data:image/png;base64,<?= $course['THUMBNAIL'] ?>" alt="<?= $course['NAME'] ?>"></a></li>
                    <?php endfor; ?>
                </ul>
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