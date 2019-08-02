<?php
    include_once '../objects/Accounts.php';
    include '../config/database.php';
    $database = new Database();
    $db = $database->getConnection();

    if($_POST) {
        $user = new Accounts($db);
        $user->id = $_POST['id'];
        $user->delete();
    }
?>