<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Création cours - Mon Site de Formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-creation.css">
  <link rel="stylesheet" href="../CSS/style-creation-cours.css">
</head>
<body>
    <?php 
        require_once 'header.php';
        if($loggedInUser['ROLE'] != 1){
            header('Location: index.php');
        }
        ob_end_flush();
    ?>
  <h1>Créer un cours</h1>
  <p>Ajoutez un nouveau cours sur la plateform Mon site de formation</p>
  </header>
  <main>
    <section>
      <form action="../../controllers/CourseController.php?caction=createCourse" method="POST" enctype="multipart/form-data">
          <div class="input-group">
              <label for="name">Nom :</label>
              <input type="text" id="name" name="name" required>
          </div>
          <div class="input-group">
              <label for="tags">Tags :</label>
              <input type="text" id="tags" name="tags" placeholder="tag1,tag2,..."required>
          </div>
          <div class="input-group">
              <label for="upload-qcm">QCM (.xml) :</label>
              <input type="file" id="upload-qcm" name="qcm" accept=".xml" required>
          </div>
          <div class="input-group">
              <label for="thumbnail">Thumbnail :</label>
              <input type="file" id="thumbnail" name="thumbnail" accept=".jpg , .jpeg , .png">
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
