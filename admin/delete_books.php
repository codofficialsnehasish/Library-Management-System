<?php
    include("../db_connect.php");
    $ID = $_GET['id'];

    $q = "SELECT * FROM books WHERE id='$ID'";
    $res = $conn->query($q);
    $row = $res->fetch_assoc();
    unlink("../book_img/".$row['image']);
    $qu = "DELETE FROM books WHERE id='$ID'";
    $conn->query($qu);
    header('location: books.php');
?>