<?php 
    include('../db_connect.php');

	if(isset($_POST['get_book'])){      
        $tr_id = $_POST['tr_id'];        
        $date = new DateTime($_POST['return_date']);
		$return_date = $date->format('Y-m-d');
        $q = "UPDATE transaction SET return_date = '$return_date' WHERE id = '$tr_id'";
        $res = $conn->query($q);

        $qry = "SELECT * FROM transaction where id = '$tr_id'";
        $resss = $conn->query($qry);
        $row = $resss->fetch_assoc();
        $id = $row['book_id'];
        $qu = "UPDATE books SET avaliable_copies = avaliable_copies + 1 WHERE id = '$id'";
        $ress = $conn->query($qu);
        header('location: borrow_records.php');
    }   
?>
