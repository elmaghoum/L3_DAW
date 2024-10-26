
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Mon profil - Mon Site de Formation</title>
    <link rel="stylesheet" href="../CSS/style-profil.css">
    <link rel="stylesheet" href="../CSS/style-header.css">
  </head>
  <body>
    <?php require_once 'header.php' ?>
    <h1>Mon profil</h1>
    <p>Retrouvez ici vos informations personnelles ainsi que votre avancement sur la plateforme Mon site de formation</p>
    </header>
    <main>
      <section class="user-info">
        <h2>Mes informations personnelles</h2>
        <div id="infos">
          <img src="../../MEDIA/profile-pict.png" alt="Mon logo" width="100px">
          <div id="infos2">
            <p><span class="label">Nom :</span><span class="info">monnom</span></p>
            <p><span class="label">Prénom :</span><span class="info">monprenom</span></p>
            <p><span class="label">Mail :</span><span class="info">monmail@exemple.com</span></p>
          </div>
        </div>
      </section>
      <section class="user-cours">
        <h2>Mes cours suivis</h2>
        <ul>
          <li><a href="#">HTML/CSS</a></li>
          <li><a href="#">JavaScript</a></li>
          <li><a href="#">PHP/MySQL</a></li>
        </ul>
      </section>
      <section class="user-stats">
        <h2>Mes statistiques</h2>
        <ul>
          <li><p><span class="stats-cours">HTML/CSS</span><span class="note">7/10</span></p></li>
          <li><p><span class="stats-cours">JavaScript</span><span class="note">5/10</span></p></li>
          <li><p><span class="stats-cours">PHP/MySQL</span><span class="note">8/10</span></p></li>
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