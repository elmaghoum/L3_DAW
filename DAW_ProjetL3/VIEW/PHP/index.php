<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-index.css">
</head>
<body>
    <?php require_once "header.php" ; ?>
        <h1>Accueil</h1>
        <p>Bienvenue sur Mon site de formation ! Commencez un cours, évaluez vous ou allez sur le forum</p>
    </header>
    <main>
        <div id="left">
            <section id="section-recommandation">
                <h2>Recommandations</h2>
                <ul>
                    <li><a href="#">JavaScript</a></li>
                    <li><a href="#">PHP/MySQL</a></li>
                </ul>
            </section>
        </div>
        <div id="right">
            <section id="section-mes-cours">
                <h2>Mes cours</h2>
                <ul>
                    <li><a href="#">HTML/CSS</a></li>
                </ul>
            </section>
            <section id="section-tests">
                <h2>Evaluez vous</h2>
                <ul>
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