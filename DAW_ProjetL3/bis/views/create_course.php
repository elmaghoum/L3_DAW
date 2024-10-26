<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
</head>
<body>
    <h1>Create Course</h1>
    <form action="../controllers/CourseController.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="createCourse">
        <label for="name">Course Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="tags">Course Tags (comma-separated):</label>
        <input type="text" id="tags" name="tags" required>
        <br>
        <label for="thumbnail">Course Thumbnail:</label>
        <input type="file" id="thumbnail" name="thumbnail" accept="image/*">
        <br>
        <label for="qcm">QCM File:</label>
        <input type="file" id="qcm" name="qcm" accept=".txt">
        <br>
        <input type="submit" value="Create Course">
    </form>
</body>
</html>
