<?php
    include_once '../objects/Menus.php';
    include '../config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    if($_POST) {
        $menus = new Menus($db);
        $menus->id = $_POST['id'];
        $menus->delete();
    }
?>
