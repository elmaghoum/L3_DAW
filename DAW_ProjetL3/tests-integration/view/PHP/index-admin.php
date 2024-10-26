<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil admin - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-index.css">
  <link rel="stylesheet" href="../CSS/style-header.css">
</head>
<body>
    <?php 
        require_once "header.php" ;
        require_once "../../controllers/CourseController.php";
        $courseController = new CourseController($db);
        if($loggedInUser['ROLE'] != 1){
            header('Location: index.php');
        }
        ob_end_flush();
    ?>
        <h1>Accueil</h1>
        <p>Bienvenue sur Mon site de formation ! Commencez un cours, évaluez vous ou allez sur le forum</p>
    </header>
    <main>
        <div id="left">
            <section id="section-modif-users">
                <h2><a href="users.php" class="lien-h2">Modifier un utilisateur</a></h2>
                <ul>
                    <?php 
                        $users = $userController->listUsersAction();

                        for($i = count($users)-1; ($i >= count($users)-10) && ($i >= 0); $i--):
                            $user = $users[$i];
                            if($user['PP'] == null){
                                $pp = file_get_contents("../../MEDIA/profile-pict.png");
                                $pp = base64_encode($pp);
                            }
                            else{
                                $pp = $user['PP'];
                            }
                    ?>
                    <li>
                        <a href="modification-user.php?user_id=<?= $user['ID'] ?>">
                            <img src="data:image/png;base64, <?= $pp ?>" alt="pp" width="80px">
                            <div>
                                <p><span><?= $user['NAME'] ?></span><span><?= $user['FIRSTNAME'] ?></span></p>
                                <p><?= $user['EMAIL'] ?></p>
                            </div>
                        </a>
                    </li>
                    <?php endfor; ?>
                </ul>
            </section>
        </div>
        <div id="right">
            <section id="section-modif-cours">
                <h2><a href="lescours.php" class="lien-h2">Modifier un cours</a></h2>
                <ul class="thumbnail">
                    <?php
                        $courses = $courseController->getAllCoursesAction();
                        
                        for($i = count($courses)-1; ($i >= count($courses)-10) && ($i >= 0); $i--):
                            $course = $courses[$i];
                    ?>
                    <li><a href="modification-cours.php?course_id=<?= $course['ID'] ?>"><img src="data:image/png;base64,<?= $course['THUMBNAIL'] ?>" alt="<?= $course['NAME'] ?>"></a></li>
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