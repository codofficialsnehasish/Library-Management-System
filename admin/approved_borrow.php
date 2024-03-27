<?php
    include("../db_connect.php");
    $ID = $_GET['id'];
    $q = "UPDATE transaction SET is_approved = '1' WHERE id = '$ID'";
    $res = $conn->query($q);

    $qry = "SELECT * FROM transaction where id = '$ID'";
    $resss = $conn->query($qry);
    $row = $resss->fetch_assoc();
    $id = $row['book_id'];
    $qu = "UPDATE books SET avaliable_copies = avaliable_copies - 1 WHERE id = '$id'";
    $ress = $conn->query($qu);
    header('location: borrow_requests.php');
?>