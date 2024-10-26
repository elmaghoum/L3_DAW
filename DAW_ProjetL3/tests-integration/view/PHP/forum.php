<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Forum - Mon Site de Formation</title>
  <link rel="stylesheet" href="../CSS/style-forum.css">
  <link rel="stylesheet" href="../CSS/style-header.css">
</head>
<body>
  <?php 
    require_once 'header.php' ;
    require_once '../../controllers/PostController.php';
    $postController = new PostController($db);
    $userController = new UserController($db);
    if (isset($_SESSION['search_result'])) {
      $searchResult = $_SESSION['search_result'];
      unset($_SESSION['search_result']);
    }
    if(isset($searchResult) && !empty($searchResult)) {
      $posts = $searchResult;
    } else {
      $posts = new arrayObject();
    }
  ?>
  <h1>Forum</h1>
  <p>Bienvenue sur le forum de Mon site de formation. Posez des questions, partagez vos connaissances et discutez avec d'autres élèves.</p>
  </header>
  <main>
    <section id="section-new-post">
      <h2>Poser une question</h2>
      <form id="new-post-form" action="../../controllers/PostController.php?paction=createPost" method="POST" enctype="multipart/form-data">
        <input type="text" id="form-title" name="title" placeholder="Titre" required>
        <textarea id="form-content" name="content" placeholder="Description..." required></textarea>
        <button type="submit">Poster</button>
      </form>
    </section>
    <section id="section-posts">
      <h2>Rechercher une question</h2>
      <form id="search-form" action="../../controllers/PostController.php" method="GET" enctype="multipart/form-data">
        <input type="hidden" name="paction" value="searchPosts">
        <input type="text" id="search" name="search" placeholder="votre recherche...">
        <button type="submit">Rechercher</button>
      </form>
      <div id="posts">
        <?php
          foreach ($posts as $post) :
            $user = $userController->getUserByIdAction($post['ID_USER']);
            if($user['PP'] == null){
              $pp = file_get_contents("../../MEDIA/profile-pict.png");
              $pp = base64_encode($pp);
            }
            else{
                $pp = $user['PP'];
            }
        ?>
        <a href="template-topic.php?post_id=<?= $post['ID'] ?>">
          <div class="post">
            <div class="who-posted">
              <img src="data:image/jpeg;base64,<?= $pp ?>" alt="pp" width="50px">
              <div class="name-date-post"><p><?= $user['NAME'] ." ". $user['FIRSTNAME'] ?></p><p><?= $post['DATE'] ?></p></div>
            </div>
            <div class="title-post"><p><?= $post['TITLE'] ?></p></div>
          </div>
        </a>
        <?php endforeach; ?>
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


