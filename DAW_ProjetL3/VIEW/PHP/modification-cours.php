<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modification cours - Mon Site de Formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-creation.css">
  <link rel="stylesheet" href="../CSS/style-modification-cours.css">
</head>
<body>
  <?php require_once 'header.php' ?>
  <h1>Modifier un cours</h1>
  <p>Modifiez le contenu d'un cours, ajoutez ou modifiez des chapitres</p>
  </header>
  <main>
    <div id="left">
      <section>
        <form>
          <div class="input-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
          </div>
          <div class="input-group">
            <label for="tags">Tags :</label>
            <input type="text" id="tags" name="tags" placeholder="#tag1,#tag2,..."required>
          </div>
          <div class="input-group">
            <label for="thumbnail-cours">Thumbnail :</label>
            <input type="file" id="thumbnail-cours" name="thumbnail-cours" accept=".jpg , .jpeg , .png" required>
          </div>
          <button type="submit">Valider</button>
        </form>
      </section>
      <section>
        <button id="but-new-chapitre">+ Ajouter un chapitre</button>
      </section>
    </div>
    <div id="right">
      <section>
        <h2>Cliquez pour modifier un chapitre</h2>
        <?php for ($i=0; $i < 5; $i++) { ?>
          <a class="chapitre">
            <h2>Chapitre <?php echo $i+1 ?> : </h2>
            <p>titre du chapitre <?php echo $i+1 ?></p>
          </a>
        <?php } ?>
      </section>
    </div>
  </main>
  <footer>
    <p>Tout droit réservé © 2023 Mon site de formation</p>
  </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
</html>
