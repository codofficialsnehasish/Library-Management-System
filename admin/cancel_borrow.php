<?php
    include("../db_connect.php");
    $id = $_GET['id'];
    $q = "UPDATE `transaction` SET `is_approved` = '0' WHERE `transaction`.`id` = '$id'";
    $res = $conn->query($q);
    header('location: borrow_requests.php');
?>