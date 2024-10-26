<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>utilisateurs - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-users.css">
</head>
<body>
    <?php require_once "header.php" ; ?>
        <h1>Tous les utilisateurs</h1>
        <p>Voici la liste de tous les utilisateurs, cliquez dessus pour les modifier.</p>
    </header>
    <main>
        <section id="users-inscrits">
            <ul>
                <?php for ($i=0; $i < 20; $i++) { ?>
                <li>
                    <a href="#">
                        <img src="../../MEDIA/profile-pict.png" alt="pp" width="50px">
                        <div class="div-inscrit">
                            <p><span><?php echo "nom$i";?></span><span><?php echo "prenom$i";?></span></p>
                            <p><?php echo "nom$i.prenom$i";?>@gmail.com</p>
                        </div>
                        <p class="is-admin"><?php if(rand(0,15)==0) echo "admin"; else echo "utilisateur";?></p>
                    </a>
                </li>
                <?php } ?>
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