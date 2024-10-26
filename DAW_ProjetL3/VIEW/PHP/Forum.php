<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Forum - Mon Site de Formation</title>
  <link rel="stylesheet" href="../CSS/style-forum.css">
  <link rel="stylesheet" href="../CSS/style-header.css">
</head>
<body>
  <?php require_once 'header.php' ?>
  <h1>Forum</h1>
  <p>Bienvenue sur le forum de Mon site de formation. Posez des questions, partagez vos connaissances et discutez avec d'autres élèves.</p>
  </header>
  <main>
    <section id="section-new-post">
      <h2>Poser une question</h2>
      <form id="new-post-form">
        <select name="form-select-cours" id="form-select-cours">
          <option value="html">HTML</option>
          <option value="css">CSS</option>
          <option value="javascript">JavaScript</option>
          <option value="php">PHP</option>
        </select>
        <input type="text" id="form-title" name="form-title" placeholder="Titre" required>
        <textarea id="form-content" name="form-content" placeholder="Description..." required></textarea>
        <button type="submit">Envoyer</button>
      </form>
    </section>
    <section id="section-posts">
      <h2>Rechercher une question</h2>
      <form id="search-form">
        <select name="search-select-cours" id="search-select-cours">
          <option value="html">HTML</option>
          <option value="css">CSS</option>
          <option value="javascript">JavaScript</option>
          <option value="php">PHP</option>
        </select>
        <input type="text" id="search-title" name="search-title" placeholder="Titre">
        <button type="submit">Rechercher</button>
      </form>
      <div id="posts">
        <a href="#">
          <div class="post">
            <div class="who-posted">
              <img src="../../MEDIA/profile-pict.png" alt="pp" width="50px">
              <div class="name-date-post"><p>nom prenom</p><p>02/02/2023</p></div>
            </div>
            <div class="title-post"><p>Titre de la discussion</p><p>[nom du cours]</p></div>
          </div>
        </a>
        <a href="#">
          <div class="post">
            <div class="who-posted">
              <img src="../../MEDIA/profile-pict.png" alt="pp" width="50px">
              <div class="name-date-post"><p>nom prenom</p><p>02/02/2023</p></div>
            </div>
            <div class="title-post"><p>Titre de la discussion</p><p>[nom du cours]</p></div>
          </div>
        </a>
        <a href="#">
          <div class="post">
            <div class="who-posted">
              <img src="../../MEDIA/profile-pict.png" alt="pp" width="50px">
              <div class="name-date-post"><p>nom prenom</p><p>02/02/2023</p></div>
            </div>
            <div class="title-post"><p>Titre de la discussion</p><p>[nom du cours]</p></div>
          </div>
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


