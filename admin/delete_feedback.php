<?php
    include_once '../objects/Feedbacks.php';
    include '../config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    if($_POST) {
        $feedbacks = new Feedbacks($db);
        $feedbacks->id = $_POST['id'];
        $feedbacks->delete();
    }
?>