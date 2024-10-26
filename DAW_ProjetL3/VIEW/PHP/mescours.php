<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes cours - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-lescours.css">
</head>
<body>
  <?php require_once "header.php" ; ?>
  <h1>Mes cours</h1>
  <p>Bienvenue sur la page de vos cours. Vous pouvez accéder à vos différents cours en cliquant sur les liens ci-dessous :</p>
  </header>
  <main>
  <section>
      <div class="container-lien-cours">
        <a href="#" class="lien-cours">
          <h2>HTML/CSS</h2>
          <p>Apprenez à créer des sites web avec HTML et CSS :</p>
        </a>
      </div>
        <ul>
          <li><a href="#">Chapitre 1 : Introduction à HTML</a></li>
          <li><a href="#">Chapitre 2 : Introduction à CSS</a></li>
          <li><a href="#">Chapitre 3 : Structurer une page web avec HTML</a></li>
          <li><a href="#">Chapitre 4 : Mettre en forme une page web avec CSS</a></li>
        </ul>
    </section>
    <section>
      <div class="container-lien-cours">
        <a href="#" class="lien-cours">
          <h2>JavaScript</h2>
          <p>Apprenez à programmer avec JavaScript :</p>
        </a>
      </div>
      <ul>
        <li><a href="#">Chapitre 1 : Introduction à JavaScript</a></li>
        <li><a href="#">Chapitre 2 : Variables et opérateurs</a></li>
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


