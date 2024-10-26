<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Cours - Mon site de formation</title>
  <link rel="stylesheet" href="../CSS/style-header.css">
  <link rel="stylesheet" href="../CSS/style-template-cours.css">
</head>
<body>
    <?php 
        require_once "header.php" ;
        require_once "../../controllers/CourseController.php";
        require_once "../../controllers/ChapterController.php";
        require_once "../../controllers/QcmController.php";
        $courseController = new CourseController($db);
        $chapterController = new ChapterController($db);
        $qcmController = new QcmController($db);
        $currentCourse = $courseController->getCourseById($_GET['course_id']);
        function isRegisteredToCourse($courseId, $registeredCourses) {
            foreach ($registeredCourses as $registeredCourse) {
                if ($registeredCourse['ID'] == $courseId) {
                    return true;
                }
            }
            return false;
        }
    ?>
        <h1><?php echo $currentCourse['NAME']; ?></h1>
    </header>
    <main>
        <section>
            <form action="../../controllers/UserController.php" id="form-suivre" method="POST">
                <input type="hidden" name="courseId" value="<?php echo $currentCourse['ID']; ?>">
                <?php 
                    $registeredCourses = $userController->getCoursesByUserIdAction($loggedInUser['ID']);
                    if(!isRegisteredToCourse($currentCourse['ID'], $registeredCourses)):
                ?>
                    <input type="hidden" name="action" value="registerUserToCourse">
                    <button id="but-suivre">Suivre le cours</button>
                <?php else: ?>
                    <input type="hidden" name="action" value="leaveCourse">
                    <button id="but-suivre">Ne plus suivre le cours</button>
                <?php endif; ?>
            </form>
        </section>
        <section class="section-eval">
            <div class="container-eval">
                <?php
                    $total = $qcmController->getTotalQuestionsByCourseId($currentCourse['ID']);
                    $note = $userController->getUserNote($loggedInUser['ID'], $currentCourse['ID']);
                ?>
                <a href="template-test.php?course_id=<?php echo $currentCourse['ID']; ?>" class="lien-eval">
                    <h2>Evaluation</h2>
                    <?php if (isset($note['NOTE'])) : ?>
                    <p><span>Sur ce cours, vous avez été évaluez à :</span><span class="note"><?php echo $note['NOTE'] ."/".$total; ?></span><span>Cliquez pour repasser le test !</span></p>
                    <?php else : ?>
                    <p><span>Vous n'avez pas encore été évalué sur ce cours</span><span>Cliquez pour passer le test !</span></p>
                    <?php endif; ?>
                </a>
            </div>
        </section>
        <?php
            $chapters = $chapterController->getChaptersByCourseId($currentCourse['ID']);
            foreach ($chapters as $chapter):
        ?>
        <section>
            <h2>Chapitre <?= $chapter['NUMERO_CHAP'] ?> : <?= $chapter['NAME'] ?></h2>
            <div class="container-chapitre">
                <a href="template-chapitre.php?chapter_id=<?= $chapter['ID'] ?>" class="lien-chapitre">
                    <img src="data:image/png;base64,<?= $chapter['THUMBNAIL'] ?>" alt="<?= $chapter['NAME'] ?>"  class="thumbnail">
                </a>
            </div>
        </section>
        <?php endforeach; ?>
    </main>
    <footer>
        <p>Tout droit réservé © 2023 Mon site de formation</p>
    </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../JS/script-header.js"></script>
</html>