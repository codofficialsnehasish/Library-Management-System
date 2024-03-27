<?php
    include("../db_connect.php");
    $ID = $_GET['id'];
    $qu = "DELETE FROM users WHERE id='$ID'";
    $conn->query($qu);
    header('location: users.php');
?>