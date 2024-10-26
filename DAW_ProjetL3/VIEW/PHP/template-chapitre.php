<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Nom chapitre - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-template-chapitre.css">
</head>
<body>
    <?php require_once "header.php" ; ?>
        <h1>Chapitre 1 : Introduction à HTML</h1>
        <p>Dans ce chapitre, découvrez ce qu'est le HTML, et faites vos premières lignes de code</p>
    </header>
    <main>
        <section>
            <h2>Cours vidéo</h2>
            <iframe class="media" src="../../MEDIA/test.mp4" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </section>
        <section>
            <h2>Cours PDF</h2>
            <embed class="media" src="../../MEDIA/test.pdf" type='application/pdf'/>
        </section>
    </main>
    <footer>
        <p>Tout droit réservé © 2023 Mon site de formation</p>
    </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
</html>