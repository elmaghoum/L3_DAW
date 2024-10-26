<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Forum - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-template-topic.css">
</head>
<body>
    <?php require_once "header.php" ; ?>
        <h1>Forum</h1>
        <p>Bienvenue sur le forum de Mon site de formation. Posez des questions, partagez vos connaissances et discutez avec d'autres élèves.</p>
    </header>
    <main>
    <section id="section-topic">
        <h2>Comment intégrer une vidéo dans l'HTML ?</h2>
        <h3>[ HTML/CSS ]</h3>
        <div class="post question">
            <div class="who-posted">
              <img src="../../MEDIA/profile-pict.png" alt="pp" width="50px">
              <div class="name-date-post"><p>nom prenom</p><p>02/02/2023</p></div>
            </div>
            <p class="content">Je voudrais intégrer une vidéo dans mon site web, mais je ne sais pas comment faire. Quelqu'un peut m'aider ?</p>
        </div>
        <div class="post reponse">
            <div class="who-posted">
              <img src="../../MEDIA/profile-pict.png" alt="pp" width="50px">
              <div class="name-date-post"><p>nom prenom</p><p>02/02/2023</p></div>
            </div>
            <p class="content">Pour cela il faut utiliser la balise &lt;video&gt; et mettre le lien de la vidéo dans l'attribut src.</p>
        </div>
        <div class="post reponse">
            <div class="who-posted">
              <img src="../../MEDIA/profile-pict.png" alt="pp" width="50px">
              <div class="name-date-post"><p>nom prenom</p><p>02/02/2023</p></div>
            </div>
            <p class="content">Voici un exemple de code : &lt;video src="lien-de-la-video"&gt;&lt;/video&gt;</p>
        </div>
        <div class="post question">
            <div class="who-posted">
              <img src="../../MEDIA/profile-pict.png" alt="pp" width="50px">
              <div class="name-date-post"><p>nom prenom</p><p>02/02/2023</p></div>
            </div>
            <p class="content">Merci pour votre aide ! ça fonctionne parfaitement.</p>
        </div>
    </section>
    <section id="section-repondre">
        <form>
            <h2>Répondre</h2>
            <textarea name="to-send-response" id="to-send-reponse" placeholder="Ecrivez votre réponse..." required></textarea>
            <input type="submit" value="Envoyer">
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