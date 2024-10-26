<!-- edit_user.php -->
<?php
include 'index.php';
$user = $userController->getUserByIdAction($_SESSION['user_id']);
?>
<form method="POST" action="../controllers/UserController.php">
    <input type="hidden" name="action" value="updateUser">
    <input type="hidden" name="user_id" value="<?= $user['ID'] ?>">
    
    <button type="submit">Update</button>
</form>
