
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modification chapitre - Mon Site de Formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-creation.css">
</head>
<body>
  <?php require_once 'header.php' ?>
  <h1>Modifier un chapitre</h1>
  <p>Modifier le chapitre i du cours : nom du cours</p>
  </header>
  <main>
    <section>
        <form>
            <div class="new-chapitre">
                <div class="input-group">
                    <label for="numero-chapitre-1">Numero chapitre :</label>
                    <input type="number" id="numero-chapitre-1" name="numero-chapitre-1" min="1" max="99" required>
                </div>
                <div class="input-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="input-group">
                    <label for="video-chapitre-1">Video :</label>
                    <input type="file" id="video-chapitre-1" name="video-chapitre-1" accept=".mp4" required>
                </div>
                <div class="input-group">
                    <label for="pdf-chapitre-1">PDF :</label>
                    <input type="file" id="pdf-chapitre-1" name="pdf-chapitre-1" accept=".pdf" required>
                </div>
                <div class="input-group">
                    <label for="thumbnail-chapitre-1">Thumbnail :</label>
                    <input type="file" id="thumbnail-chapitre-1" name="thumbnail-chapitre-1" accept=".jpg , .jpeg , .png" required>
                </div>
                <div class="input-group">
                    <button id="but-sup-chapitre">- Supprimer le chapitre</button>
                </div>
                <button type="submit">Valider</button>
            </div>
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