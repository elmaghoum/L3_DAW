<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Test - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-template-test.css">
</head>
<body>
    <?php 
        require_once "header.php" ; 
        require_once '../../controllers/QcmController.php';
        require_once '../../controllers/CourseController.php';
        $qcmController = new QcmController($db);
        $courseController = new CourseController($db);
        $currentCourse = $courseController->getCourseById($_GET['course_id']);
        $questions = $qcmController->getQcmQuestionsByCourseId2($currentCourse['ID']);
    ?>
        <h1>Test du cours <?php echo $currentCourse['NAME']; ?></h1>
        <p>Répondez au question pour vous évaluez sur ce cours. Une seule bonne réponse pas question</p>
    </header>
    <main>
        <form action="../../controllers/QcmController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="qaction" value="submitAnswers">
            <input type="hidden" name="course_id" value="<?php echo $currentCourse['ID']; ?>">
            <?php foreach ($questions as $index => $question): ?>
            <section>
                <h2><?php echo "Question " . $index+1;?></h2>
                <p><?= $question['interrogation'] ?>?</p>
                <ul>
                    <?php foreach ($question['propositions'] as $prop_index => $proposition): ?>
                    <li>
                        <input type="radio" id="q<?php echo $index; ?>_p<?php echo $prop_index; ?>" name="question<?php echo $index + 1; ?>" value="<?php echo $prop_index + 1; ?>" required>
                        <label for="q<?php echo $index; ?>_p<?php echo $prop_index; ?>"><?php echo $proposition; ?></label>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </section>
            <?php endforeach; ?>
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
