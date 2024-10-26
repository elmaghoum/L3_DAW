<?php
require_once '../controllers/UserController.php';

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$_SESSION['error'] = '';
$succes = isset($_SESSION['succes']) ? $_SESSION['succes'] : '';
$_SESSION['succes'] = '';

$userController = new UserController($db);
$loggedInUser = $userController->getLoggedInUserData();

if ($loggedInUser) {
    $name = $loggedInUser['NAME'] . ' ' . $loggedInUser['FIRSTNAME'];
    $pp = $loggedInUser['PP'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Site Title</title>
    <!-- Add your CSS files here -->
</head>
<body>
    <header>
        <div class="user-info">
        <img src="data:image/png;base64, <?php echo $pp; ?>" alt="Profile Picture">
            <span><?php echo $name; ?></span>
        </div>
        <!-- Add your navigation menu here -->
    </header>
    <body>
    <?php if (!empty($error)) : ?>
            <div class="alert alert-danger">
                <?=  $error ?>
            </div>
        <?php endif; ?>
    </body>
