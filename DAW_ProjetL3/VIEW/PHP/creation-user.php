<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Création utilisateur - Mon Site de Formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-creation.css">
</head>
<body>
  <?php require_once 'header.php' ?>
  <h1>Créer un utilisateur</h1>
  <p>Inscrivez un nouvel étudiant/administrateur sur la plateform Mon site de formation</p>
  </header>
  <main>
    <section>
      <form>
        <div class="input-group">
          <label for="nom">Nom :</label>
          <input type="text" id="nom" name="nom" required>
        </div>
        <div class="input-group">
          <label for="prenom">Prénom :</label>
          <input type="text" id="prenom" name="prenom" required>
        </div>
        <div class="input-group">
          <label for="email">Email :</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
          <label for="password">Mot de passe :</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
          <label for="pp">Photo de profil :</label>
          <input type="file" id="pp" name="pp"  accept=".jpg , .jpeg , .png">
        </div>
        <div class="input-group" id="input-group-checkbox">
          <input type="checkbox" id="admin" name="admin" >
          <label for="admin">Administrateur</label>
        </div>

        <button type="submit">Valider</button>
      </form>
    </section>
  </main>
  <footer>
    <p>Tout droit réservé © 2023 Mon site de formation</p>
  </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
</html>
