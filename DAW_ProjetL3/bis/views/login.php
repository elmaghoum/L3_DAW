<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$_SESSION['error'] = '';
foreach ($_SESSION as $key => $value) {
    echo $key . ' = ' . $value . '<br>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add your preferred CSS framework for styling (e.g., Bootstrap, Bulma, etc.) -->
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger">
                <?=  $error ?>
            </div>
        <?php endif; ?>
        <form action="../controllers/UserController.php?action=login" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>
