<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>utilisateurs - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-users.css">
</head>
<body>
    <?php 
        require_once 'header.php';
        $userController = new UserController($db);
        if($loggedInUser['ROLE'] != 1){
            header('Location: index.php');
        }
        ob_end_flush();
    ?>
        <h1>Tous les utilisateurs</h1>
        <p>Voici la liste de tous les utilisateurs, cliquez dessus pour les modifier.</p>
    </header>
    <main>
        <section id="users-inscrits">
            <ul>
                <?php  
                    $users = $userController->listUsersAction();
                    foreach($users as $user):
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
                        <img src="data:image/png;base64, <?= $pp ?>" alt="pp" width="50px">
                        <div class="div-inscrit">
                            <p><span><?= $user['NAME']?></span><span><?= $user['FIRSTNAME'] ?></span></p>
                            <p><?= $user['EMAIL'] ?></p>
                        </div>
                        <p class="is-admin"><?php if($user['ROLE'] == 1) echo "admin"; else echo "utilisateur";?></p>
                    </a>
                </li>
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