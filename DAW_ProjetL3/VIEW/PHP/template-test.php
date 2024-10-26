<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Test Nom cours - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-template-test.css">
</head>
<body>
    <?php require_once "header.php" ; ?>
        <h1>Test du cours HTML/CSS</h1>
        <p>Répondez au question pour vous évaluez sur ce cours. Une seule bonne réponse pas question</p>
    </header>
    <main>
        <form>
            <?php for ($i=1; $i < 11; $i++) { ?>
            <section>
                <h2><?php echo "Question $i";?></h2>
                <p>Quel est le nom du langage de programmation utilisé pour le web ?</p>
                <ul>
                    <li><input type="radio" name="<?php echo "question$i";?>" id="<?php echo "q$i";?>-1" value="1"><label for="<?php echo "q$i";?>-1">HTML</label></li>
                    <li><input type="radio" name="<?php echo "question$i";?>" id="<?php echo "q$i";?>-2" value="2"><label for="<?php echo "q$i";?>-2">JavaScript</label></li>
                    <li><input type="radio" name="<?php echo "question$i";?>" id="<?php echo "q$i";?>-3" value="3"><label for="<?php echo "q$i";?>-3">Python</label></li>
                </ul>
            </section>
            <?php } ?>
            <button type="submit" id="valider">Valider réponses</button>
        </form>
    </main>
    <footer>
        <p>Tout droit réservé © 2023 Mon site de formation</p>
    </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
</html>
