<?php
  session_start();
  $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
  $_SESSION['error'] = '';
  foreach ($_SESSION as $key => $value) {
      echo $key . ' = ' . $value . '<br>';
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Page de connexion</title>
  <link rel="stylesheet" href="../CSS/style-connexion.css">
</head>
<body>
  <main>
    <form class="login-form" action="../../controllers/UserController.php?action=login" method="post">
      <h1>Connexion</h1>
      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger">
            <?=  $error ?>
        </div>
      <?php endif; ?>
      <div class="input-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email">
      </div>
      <div class="input-group">
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password">
      </div>
      <button type="submit">Se connecter</button>
    </form>
  </main>
</body>
</html>