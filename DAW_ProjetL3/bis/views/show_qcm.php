<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show QCM</title>
</head>
<body>
    <h1>Show QCM</h1>
    <?php
    require_once '../controllers/QcmController.php';
    require_once '../config/db.php';

    $qcmController = new QcmController($db);
    $course_id = 16; // Replace this with the desired course ID
    $questions = $qcmController->getQcmQuestionsByCourseId($course_id);
    print_r($questions);
    ?>

    <form action="../controllers/QcmController.php" method="post">
        <input type="hidden" name="qaction" value="submitAnswers">
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
        <?php foreach ($questions as $index => $question): ?>
            <div>
                <p><?php echo ($index + 1) . '. ' . $question['interrogation']; ?></p>
                <?php foreach ($question['propositions'] as $prop_index => $proposition): ?>
                    <input type="radio" id="q<?php echo $index; ?>_p<?php echo $prop_index; ?>" name="question<?php echo $index + 1; ?>" value="<?php echo $prop_index + 1; ?>" required>
                    <label for="q<?php echo $index; ?>_p<?php echo $prop_index; ?>"><?php echo $proposition; ?></label><br>
                <?php endforeach; ?>
            </div>
            <br>
        <?php endforeach; ?>

        <input type="submit" value="Submit Answers">
    </form>
</body>
</html>
