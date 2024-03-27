<?php 
    include('../db_connect.php');
    include('admin_includes/header.php'); 

	if(isset($_POST['get_book'])){      
        $user_id = $_POST['user_id'];        
        $product_id = $_POST['product_id']; 
        $date = new DateTime($_POST['bdate']);
		$borrow_date = $date->format('Y-m-d');
        $dates = new DateTime($_POST['rdate']);
		$formattedDate = $dates->format('Y-m-d');

        $q = "SELECT avaliable_copies FROM books WHERE id = '$product_id'";
        $res = $conn->query($q);
		$row = $res->fetch_assoc();
        if($row['avaliable_copies'] < 1){
            $error = "Not Enough Copies Avaliable";
        }else{
            $q = "INSERT INTO transaction SET user_id = '$user_id', book_id = '$product_id', borrow_date = '$borrow_date', exptd_return_date = '$formattedDate'";
            $res = $conn->query($q);
            print_r($res);
            $error = "Successfully Registered";
        }
    }   
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('admin_includes/side_bar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('admin_includes/top_bar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Add Requests</h1>
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i>Generate Report
                    </a> -->
                    <a href="borrow_requests.php" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Back</span>
                    </a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add Requests</h6>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="sel1">Select Member:</label>
                                <select class="form-control" name="user_id">
                                    <?php
                                    $q = "SELECT * FROM users where role != 'admin'";
                                    $res = $conn->query($q);
                                    while ($row = $res->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sel1">Select Books:</label>
                                <select class="form-control" name="product_id">
                                    <?php
                                    $q = "SELECT * FROM books";
                                    $res = $conn->query($q);
                                    while ($row = $res->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="authors">Borrow Date</label>
                                <input type="date" name="bdate" class="form-control" id="authors" placeholder="Enter date">
                            </div>

                            <div class="form-group">
                                <label for="authors">Expected Return Date</label>
                                <input type="date" name="rdate" class="form-control" id="authors" placeholder="Enter date">
                            </div>
                            <button type="submit" name="get_book" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                </div>
                <!-- /.container-fluid -->

                </div>
            <!-- End of Main Content -->

            <?php include('admin_includes/footer.php'); ?>
