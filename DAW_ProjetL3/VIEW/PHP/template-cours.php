<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Nom cours - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-template-cours.css">
</head>
<body>
    <?php require_once "header.php" ; ?>
        <h1>Cours HTML/CSS</h1>
        <p>Bienvenue sur le cours HTML/CSS, apprenez à faire vos premières pages web</p>
    </header>
    <main>
        <section>
            <button id="but-suivre">Suivre le cours</button>
        </section>
        <section class="section-eval">
            <div class="container-eval">
                <a href="#" class="lien-eval">
                    <h2>Evaluation</h2>
                    <p><span>Sur ce cours, vous avez été évaluez à :</span><span class="note">7/10</span><span>Cliquez pour repasser le test !</span></p>
                </a>
            </div>
        </section>
        <section>
            <h2>Chapitre 1 : Introduction à HTML</h2>
            <div class="container-chapitre">
                <a href="#" class="lien-chapitre">
                    <img src="../../MEDIA/thumbnail-chap1.png" alt="THUMBNAIL CHAPITRE 1"  class="thumbnail">
                </a>
            </div>
        </section>
        <section>
            <h2>Chapitre 2 : Introduction à CSS</h2>
            <div class="container-chapitre">
                <a href="#" class="lien-chapitre">
                    <img src="../../MEDIA/thumbnail-chap2.png" alt="THUMBNAIL CHAPITRE 2" class="thumbnail">
                </a>
            </div>
        </section>
        <section>
            <h2>Chapitre 3 : Structurer une page web avec HTML</h2>
            <div class="container-chapitre">
                <a href="#" class="lien-chapitre">
                    <img src="../../MEDIA/thumbnail-chap3.png" alt="THUMBNAIL CHAPITRE 3" class="thumbnail">
                </a>
            </div>
        </section>
        <section>
            <h2>Chapitre 4 : Mettre en forme une page web avec CSS</h2>
            <div class="container-chapitre">
                <a href="#" class="lien-chapitre">
                    <img src="../../MEDIA/thumbnail-chap4.png" alt="THUMBNAIL CHAPITRE 4" class="thumbnail">
                </a>
            </div>
        </section>
    </main>
    <footer>
        <p>Tout droit réservé © 2023 Mon site de formation</p>
    </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
</html>