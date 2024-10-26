<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Création utilisateur - Mon Site de Formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-creation.css">
</head>
<body>
    <?php 
        require_once 'header.php';
        if($loggedInUser['ROLE'] != 1){
            header('Location: index.php');
        }
        ob_end_flush();
    ?>
  <h1>Créer un utilisateur</h1>
  <p>Inscrivez un nouvel étudiant/administrateur sur la plateform Mon site de formation</p>
  </header>
  <main>
    <section>
      <form action="../../controllers/UserController.php?action=register" method="POST" enctype="multipart/form-data">
        <div class="input-group">
          <label for="name">Nom :</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
          <label for="firstname">Prénom :</label>
          <input type="text" id="firstname" name="firstname" required>
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
          <input type="hidden" name="role" value="0">
          <input type="checkbox" id="role" name="role" value="1">
          <label for="role">Administrateur</label>
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
