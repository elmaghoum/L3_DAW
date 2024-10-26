<?php include 'index.php'; ?>

<h1>Test Page</h1>

<!-- Test: Register a user -->
<form action="../controllers/UserController.php?action=register" method="POST" enctype="multipart/form-data">
    <h2>Register a User</h2>
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="firstname" placeholder="First Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="hidden" name="role" value="0">
    <label for="pp">Profile Picture:</label>
    <input type="file" name="pp" id="pp" accept="image/*" required>
    <button type="submit">Register</button>
</form>

<!-- Test: Create a post -->
<form action="../controllers/PostController.php?action=createPost" method="POST">
    <h2>Create a Post</h2>
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="content" placeholder="Content" required></textarea>
    <button type="submit">Create Post</button>
</form>

<!-- Test: Answer to a post -->
<form action="../controllers/PostController.php?action=createResponse" method="POST">
    <h2>Answer to a Post</h2>
    <input type="number" name="post_id" placeholder="Post ID" required>
    <textarea name="content" placeholder="Content" required></textarea>
    <button type="submit">Answer Post</button>
</form>

<!-- Test: Mark a post as resolved -->
<form action="../controllers/PostController.php?action=markPostAsResolved" method="POST">
    <h2>Mark a Post as Resolved</h2>
    <input type="number" name="post_id" placeholder="Post ID" required>
    <button type="submit">Mark Resolved</button>
</form>

<!-- Test: Search for a post -->
<form action="../controllers/PostController.php?action=searchPosts" method="POST">
    <h2>Search for a Post</h2>
    <input type="text" name="search" placeholder="Search" required>
    <button type="submit">Search</button>
</form>


<!-- Add a response to a post -->
<form method="POST" action="../controllers/PostController.php">
    <input type="hidden" name="action" value="createResponse">
    <input type="hidden" name="post_id" value="POST_ID">
    <textarea name="content" required></textarea>
    <button type="submit">Add response</button>
</form>

<!-- Delete a post -->
<form method="POST" action="../controllers/PostController.php">
    <input type="hidden" name="action" value="deletePost">
    <input type="hidden" name="post_id" value="YOUR_POST_ID">
    <button type="submit">Delete post</button>
</form>


<!-- View all responses of a post -->
<a href="../controllers/PostController.php?action=viewResponses&post_id=POST_ID">View all responses</a>


<?php

$users = $userController->listUsersAction();
?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Firstname</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['ID'] ?></td>
            <td><?= $user['NAME'] ?></td>
            <td><?= $user['FIRSTNAME'] ?></td>
            <td><?= $user['EMAIL'] ?></td>
            <td>
                <!-- Delete user button -->
                <form method="POST" action="../controllers/UserController.php">
                    <input type="hidden" name="action" value="deleteUser">
                    <input type="hidden" name="user_id" value="<?= $user['ID'] ?>">
                    <button type="submit">Delete</button>
                </form>

                <!-- Edit user button -->
                <a href="edit_user.php?user_id=<?= $user['ID'] ?>">Edit</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>





<?php
require_once '../controllers/CourseController.php';
$courseController = new CourseController($db);
$courses = $courseController->getAllCoursesAction();
$registeredCourses = $userController->getCoursesByUserIdAction($_SESSION['user_id']);

// Helper function to check if the user is already registered for a course
function isRegistered($courseId, $registeredCourses) {
    foreach ($registeredCourses as $registeredCourse) {
        if ($registeredCourse['ID'] == $courseId) {
            return true;
        }
    }
    return false;
}


echo "<h2>ALL Courses</h2>";

foreach ($courses as $course) {
    echo "Title: " . $course['NAME'] . "<br>";
    echo "Content: " . $course['TAGS'] . "<br>";

    if (!isRegistered($course['ID'], $registeredCourses)) {
        echo '<form action="../controllers/userController.php" method="post">';
        echo '<input type="hidden" name="action" value="registerUserToCourse">';
        echo '<input type="hidden" name="courseId" value="' . $course['ID'] . '">';
        echo '<input type="submit" value="Register">';
        echo '</form>';
    }
    echo "<hr>";
}
?>




<?php
// Display registered courses
echo "<h2>Registered Courses</h2>";
$registeredCourses = $userController->getCoursesByUserIdAction($_SESSION['user_id']);

foreach ($registeredCourses as $registeredCourse) {
    echo "Title: " . $registeredCourse['NAME'] . "<br>";
    echo "Content: " . $registeredCourse['TAGS'] . "<br>";
    echo '<form action="../controllers/userController.php" method="post">';
    echo '<input type="hidden" name="action" value="leaveCourse">';
    echo '<input type="hidden" name="courseId" value="' . $registeredCourse['ID'] . '">';
    echo '<input type="submit" value="Retire">';
    echo '</form>';
    echo "<hr>";
}

// Display suggested courses
echo "<h2>Suggested Courses</h2>";
$suggestedCourses = $userController->suggestCoursesByTagsAction2($_SESSION['user_id']);

foreach ($suggestedCourses as $suggestedCourse) {
    echo "Title: " . $suggestedCourse['NAME'] . "<br>";
    echo "Content: " . $suggestedCourse['TAGS'] . "<br>";

    if (!isRegistered($suggestedCourse['ID'], $registeredCourses)) {
        echo '<form action="../controllers/userController.php" method="post">';
        echo '<input type="hidden" name="action" value="registerUserToCourse">';
        echo '<input type="hidden" name="courseId" value="' . $course['ID'] . '">';
        echo '<input type="submit" value="Register">';
        echo '</form>';
    }
    echo "<hr>";
}
?>



<?php
require_once '../controllers/ChapterController.php';
$ChapterController = new ChapterController($db);
$ChapterController->getAllChapters();
$ChapterController->getChaptersByCourseId(1);
$chapterController = new ChapterController($db);

// Test creating a chapter
$courseId = 9; // Replace this with an existing course ID in your database
$name = "Example Chapter";
$url_pdf = "https://example.com/pdf";
$url_video = "https://example.com/video";
$chapter_number = 1;
$thumbnail = "";
$newChapterId = $chapterController->addChapter($courseId, $name, $url_pdf, $url_video, $chapter_number, $thumbnail);
echo "New chapter created with ID: " . $newChapterId . "<br>";

// Test showing all chapters of a course
$chapters = $chapterController->getChaptersByCourseId($courseId);
echo "Chapters in Course ID " . $courseId . ":<br>";
foreach ($chapters as $chapter) {
    echo "Chapter ID: " . $chapter['ID'] . "<br>";
    echo "Chapter Name: " . $chapter['NAME'] . "<br>";
    echo "Chapter PDF URL: " . $chapter['URL_PDF'] . "<br>";
    echo "Chapter Video URL: " . $chapter['URL_VIDEO'] . "<br>";
    echo "Chapter Number: " . $chapter['NUMERO_CHAP'] . "<br>";
    echo "<hr>";
}

// Test deleting a chapter
$deletedRows = $chapterController->deleteChapter($newChapterId);
echo "Deleted " . $deletedRows . " chapter(s) with ID: " . $newChapterId . "<br>";



echo "<h2>SEARCH COURSES</h2>";
$suggestedCourses = $courseController->searchCoursesByTitleAndContentAction("CCWDSP");

foreach ($suggestedCourses as $suggestedCourse) {
    echo "Title: " . $suggestedCourse['NAME'] . "<br>";
    echo "Content: " . $suggestedCourse['TAGS'] . "<br>";

    if (!isRegistered($suggestedCourse['ID'], $registeredCourses)) {
        echo '<form action="../controllers/userController.php" method="post">';
        echo '<input type="hidden" name="action" value="registerUserToCourse">';
        echo '<input type="hidden" name="courseId" value="' . $course['ID'] . '">';
        echo '<input type="submit" value="Register">';
        echo '</form>';
    }
    echo "<hr>";
}

?>






<h2>CREATE COURSE</h2>

<form action="../controllers/CourseController.php" method="post" enctype="multipart/form-data">
    <label for="name">Course Name:</label>
    <input type="text" name="name" required><br>
    <label for="tags">Tags:</label>
    <input type="text" name="tags"><br>
    <label for="thumbnail">Thumbnail:</label>
    <input type="file" name="thumbnail" required><br>
    <input type="hidden" name="action" value="createCourse">
    <input type="submit" value="Create Course">
</form>



 <?php
echo "<h2>ALL Courses WITH EDIT</h2>";

foreach ($courses as $course) {
    echo "Title: " . $course['NAME'] . "<br>";
    echo "Content: " . $course['TAGS'] . "<br>";

    if (!isRegistered($course['ID'], $registeredCourses)) {
        echo '<form action="../controllers/userController.php" method="post">';
        echo '<input type="hidden" name="action" value="registerUserToCourse">';
        echo '<input type="hidden" name="courseId" value="' . $course['ID'] . '">';
        echo '<input type="submit" value="Register">';
        echo '</form>';
    }

    // Edit button form
    echo '<form action="../views/edit_course.php" method="get">';
    echo '<input type="hidden" name="courseId" value="' . $course['ID'] . '">';
    echo '<input type="submit" value="Edit">';
    echo '</form>';

    echo "<hr>";
}
?>



<h2>Disconnect</h2>
<a href="../controllers/UserController.php?action=logout">Logout</a>
<br>

</body>
</html>
