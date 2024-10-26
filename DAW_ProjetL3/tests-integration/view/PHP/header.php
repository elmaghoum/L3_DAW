<?php
  ob_start();
  require_once 'C:\Users\utilisateur\Documents\universite\L3\S6\DAW\Projet\DAW_projet\tests-integration\controllers\UserController.php';

  $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
  $_SESSION['error'] = '';
  $succes = isset($_SESSION['succes']) ? $_SESSION['succes'] : '';
  $_SESSION['succes'] = '';

  $userController = new UserController($db);
  $loggedInUser = $userController->getLoggedInUserData();

  if ($loggedInUser) {
      $name = $loggedInUser['NAME'] . ' ' . $loggedInUser['FIRSTNAME'];
      $pp = $loggedInUser['PP'];
      if($pp == null){
        $pp = file_get_contents("../../MEDIA/profile-pict.png");
        $pp = base64_encode($pp);
      }
  }
  else {
      header('Location: connexion.php');
  }
?>
<header>
    <div id="header-top">
      <div id="burger" class="container" onmouseleave="mouseLeavePP()">
        <img src="data:image/png;base64, <?php echo $pp; ?>" alt="pp" id="profile-pict" width="100px" onmouseover="mouseOverPP()">
        <ul id="options-burger" onmouseleave="mouseLeavePP()">
          <li id="option-1" class="options-burger"><a href="profil.php"><img src="../../MEDIA/svg-pp.svg" alt="profil" width="70px"></a></li>
          <li id="option-2" class="options-burger"><a href="#"><img src="../../MEDIA/svg-light-theme.svg" alt="theme" width="70px"></a></li>
          <li id="option-3" class="options-burger"><a href="../../controllers/UserController.php?action=logout"><img src="../../MEDIA/svg-deconnexion.svg" alt="deconnexion" width="70px"></a></li>
        </ul>
      </div>
      <div id="container-logo" class="container">
        <a href=<?php if($loggedInUser['ROLE']==1) echo "index-admin.php";else echo "index.php";?>><img src="../../MEDIA/logo.png" alt="Logo de votre site" width="100px"></a>
      </div>
      <div id="container-name" class="container">
        <a href="profil.php"><?php echo $loggedInUser['NAME'] . " " . $loggedInUser['FIRSTNAME']; ?></a>
      </div>
    </div>
    <?php 
      if($loggedInUser['ROLE'] == 1){
        require_once 'nav-admin.php' ;
      }
      else{
        require_once 'nav-user.php' ;
      }
    ?>
