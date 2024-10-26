<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Forum - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-template-topic.css">
</head>
<body>
    <?php 
      require_once "header.php" ;
      require_once '../../controllers/PostController.php';
      $userController = new UserController($db);
      $postController = new PostController($db);
      $currentPost = $postController->getPostByIdAction($_GET['post_id']); 
    ?>
        <h1>Forum</h1>
        <p>Bienvenue sur le forum de Mon site de formation. Posez des questions, partagez vos connaissances et discutez avec d'autres élèves.</p>
    </header>
    <main>
      <section>
        <?php 
          if($loggedInUser['ID'] == $currentPost['ID_USER'] && $currentPost['RESOLVED'] == 0){
        ?>
        <form action="../../controllers/PostController.php?paction=markPostAsResolved" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="post_id" value="<?php echo $currentPost['ID']; ?>">
          <button type="submit">Marquer comme résolu</button>
        </form>
        <?php
          }
        ?>
      </section>
    <section id="section-topic">
        <h2><?php echo $currentPost['TITLE']; ?></h2>
        <div class="post question">
            <div class="who-posted">
              <?php 
                $user = $userController->getUserByIdAction($currentPost['ID_USER']);
                if($user['PP'] == null){
                  $pp = file_get_contents("../../MEDIA/profile-pict.png");
                  $pp = base64_encode($pp);
                }
                else{
                    $pp = $user['PP'];
                }
              ?>
              <img src="data:image/png;base64,<?php echo $pp; ?>" alt="pp" width="50px">
              <div class="name-date-post"><p><?php echo $user['NAME'] . " " . $user['FIRSTNAME']; ?></p><p><?php echo $currentPost['DATE']; ?></p></div>
            </div>
            <p class="content"><?php echo $currentPost['CONTENT']; ?></p>
        </div>
        <?php
          $reponses = $postController->getResponsesByPostId($currentPost['ID']);
          foreach($reponses as $reponse):
            $currentUser = $userController->getUserByIdAction($reponse['ID_USER']);
            if($currentUser['PP'] == null){
              $pp = file_get_contents("../../MEDIA/profile-pict.png");
              $pp = base64_encode($pp);
            }
            else{
                $pp = $currentUser['PP'];
            }
        ?>
        <div class="post <?php if($user['ID'] == $currentUser['ID']) echo "question"; else echo "reponse"; ?>">
            <div class="who-posted">
              <img src="data:image/png;base64,<?php echo $pp; ?>" alt="pp" width="50px">
              <div class="name-date-post"><p><?php echo $currentUser['NAME'] . " " . $currentUser['FIRSTNAME']; ?></p><p><?php echo $reponse['DATE']; ?></p></div>
            </div>
            <p class="content"><?php echo $reponse['CONTENT']; ?></p>
        </div>
        <?php endforeach; ?>
    </section>
    <?php
      if($currentPost['RESOLVED'] == 0){
    ?>
    <section id="section-repondre">
        <form action="../../controllers/PostController.php?paction=createResponse" method="POST" enctype="multipart/form-data">
            <h2>Répondre</h2>
            <input type="hidden" name="post_id" value="<?php echo $currentPost['ID']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $loggedInUser['ID']; ?>">
            <textarea name="content" id="to-send-reponse" placeholder="Ecrivez votre réponse..." required></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </section>
    <?php
      }
    ?>
    </main>
    <footer>
        <p>Tout droit réservé © 2023 Mon site de formation</p>
    </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
</html>