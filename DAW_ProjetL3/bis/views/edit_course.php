<?php
require_once '../controllers/CourseController.php';
require_once '../controllers/ChapterController.php';

// Initialize controllers
$courseController = new CourseController($db);
$chapterController = new ChapterController($db);

// Get course and chapters
$courseId = $_GET['courseId'];
$course = $courseController->getCourseById($courseId);
$chapters = $chapterController->getChaptersByCourseId($courseId);

// Course editing form
echo '<h2>Edit Course</h2>';
echo '<form action="../controllers/CourseController.php" enctype="multipart/form-data" method="post">';
echo '<label for="name">Course Name:</label>';
echo '<input type="text" name="name" value="' . $course['NAME'] . '"><br>';
echo '<label for="tags">Tags:</label>';
echo '<input type="text" name="tags" value="' . $course['TAGS'] . '"><br>';
echo '<label for="thumbnail">Thumbnail:</label>';
echo '<input type="file" name="thumbnail"><br>';
echo '<input type="hidden" name="action" value="updateCourse">';
echo '<input type="hidden" name="courseId" value="' . $course['ID'] . '">';
echo '<input type="submit" value="Save Changes">';
echo '</form>';

// Display chapters and add a form for creating new chapters
echo '<h2>Chapters</h2>';
foreach ($chapters as $chapter) {
    // Display chapter information
    echo 'Chapter ' . $chapter['NUMERO_CHAP'] . ': ' . $chapter['NAME'] . '<br>';

    // Add edit chapter button
    echo '<a href="../views/edit_chapter.php?chapterId=' . $chapter['ID'] . '">Edit</a>';
    echo '<hr>';
}


// Add chapter form
echo '<h2>Add Chapter</h2>';
echo '<form action="../controllers/ChapterController.php" method="post" enctype="multipart/form-data">';
echo '<label for="name">Chapter Name:</label>';
echo '<input type="text" name="name" required><br>';
echo '<label for="url_pdf">PDF URL:</label>';
echo '<input type="file" name="url_pdf" accept="application/pdf"><br>';
echo '<label for="url_video">Video URL:</label>';
echo '<input type="file" name="url_video" accept="video/*"><br>';
echo '<label for="chapter_number">Chapter Number:</label>';
echo '<input type="number" name="chapter_number" required><br>';
echo '<input type="hidden" name="action" value="addChapter">';
echo '<input type="hidden" name="courseId" value="' . $course['ID'] . '">';
echo '<input type="submit" value="Add Chapter">';
echo '</form>';




?>