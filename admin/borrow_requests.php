<?php 
    include('../db_connect.php');
    include('admin_includes/header.php'); 
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
                    <h1 class="h3 mb-0 text-gray-800">Borrow Requests</h1>
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i>Generate Report
                    </a> -->
                    <a href="add_requests.php" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Add Requests</span>
                    </a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Borrow Requests</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Member Name</th>
                                        <th>Book Name</th>
                                        <th>Borrow Date</th>
                                        <th>Expected Return Date</th>
                                        <th>Return Date</th>
                                        <!-- <th>Fine Amount</th>
                                        <th>Fine Paid</th> -->
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    // $q = "SELECT * FROM users where role != 'admin'";
                                    $q = "SELECT users.name AS user_name, books.title AS book_name, transaction.* FROM `transaction` LEFT JOIN users ON transaction.user_id = users.id LEFT JOIN books ON transaction.book_id = books.id where transaction.is_approved = 2;";
                                    $res = $conn->query($q);
                                    while ($row = $res->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['user_name']; ?></td>
                                        <td><?php echo $row['book_name']; ?></td>
                                        <td>
                                            <?php 
                                                $date = new DateTime($row['borrow_date']);
                                                echo $date->format('j F, Y');
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $date = new DateTime($row['exptd_return_date']);
                                                echo $date->format('j F, Y');
                                            ?>
                                        </td>
                                        <td><?php echo $row['return_date']; ?></td>
                                        <!-- <td><?php //echo $row['fine_amount']; ?></td>
                                        <td><?php //echo $row['fine_paid']; ?></td> -->
                                        <td>
                                            <?php if($row['is_approved'] == 1){ ?>
                                                <b class="text-success">Approved</b>
                                            <?php }elseif($row['is_approved'] == 0){ ?>
                                                <b class="text-danger">Canceled</b>
                                            <?php }else{ ?>
                                            <a class="btn btn-success" href="approved_borrow.php?id=<?php echo $row['id'];?>">Approved</a>
                                            <a class="btn btn-danger" onclick = "confirm('Are you sure?')" href="cancel_borrow.php?id=<?php echo $row['id']; ?>">Cancel</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                </div>
                <!-- /.container-fluid -->

                </div>
            <!-- End of Main Content -->

            <?php include('admin_includes/footer.php'); ?>
