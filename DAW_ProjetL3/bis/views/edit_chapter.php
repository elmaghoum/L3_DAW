<?php
require_once '../controllers/CourseController.php';
require_once '../controllers/ChapterController.php';

$chapter_id = isset($_GET['chapterId']) ? $_GET['chapterId'] : null;

if (!$chapter_id) {
    echo 'Invalid chapter ID';
    exit;
}

$ChapterController = new ChapterController($db);
$chapter = $ChapterController->getChapterById($chapter_id);

if (!$chapter) {
    echo 'Chapter not found';
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Chapter</title>
</head>
<body>
    <h1>Edit Chapter</h1>
    <form action="../controllers/ChapterController.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="updateChapter">
        <input type="hidden" name="chapterId" value="<?php echo $chapter_id; ?>">

        <label for="name">Chapter Name:</label>
        <input type="text" name="name" value="<?php echo $chapter['NAME']; ?>"><br>

        <label for="url_pdf">PDF File:</label>
        <input type="file" name="url_pdf"><br>

        <label for="url_video">Video File:</label>
        <input type="file" name="url_video"><br>

        <label for="thumbnail">Thumbnail:</label>
        <input type="file" name="thumbnail"><br>
        <label for="chapter_number">Chapter Number:</label>
        <input type="number" name="chapter_number" value="<?php echo $chapter['NUMERO_CHAP']; ?>"><br>

        <input type="submit" value="Update Chapter">
    </form>
</body>
</html>
