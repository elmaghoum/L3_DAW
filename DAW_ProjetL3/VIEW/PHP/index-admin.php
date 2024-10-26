<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil admin - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-index.css">
  <link rel="stylesheet" href="../CSS/style-header.css">
</head>
<body>
    <?php require_once "header.php" ; ?>
        <h1>Accueil</h1>
        <p>Bienvenue sur Mon site de formation ! Commencez un cours, évaluez vous ou allez sur le forum</p>
    </header>
    <main>
        <div id="left">
            <section id="section-modif-users">
                <h2>Modifier un utilisateur</h2>
                <ul>
                    <li>
                        <a href="#">
                            <img src="../../MEDIA/profile-pict.png" alt="pp" width="80px">
                            <div>
                                <p><span>Monnom</span><span>Monprenom</span></p>
                                <p>nom.prenom@gmail.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="../../MEDIA/profile-pict.png" alt="pp" width="80px">
                            <div>
                                <p><span>Exemplen</span><span>Exemplep</span></p>
                                <p>exemple@gmail.com</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </section>
        </div>
        <div id="right">
            <section id="section-modif-cours">
                <h2>Modifier un cours</h2>
                <ul>
                    <li><a href="#">HTML/CSS</a></li>
                    <li><a href="#">JavaScript</a></li>
                    <li><a href="#">PHP/MySQL</a></li>
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