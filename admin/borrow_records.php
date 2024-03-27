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
                    <h1 class="h3 mb-0 text-gray-800">All Borrow Records</h1>
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i>Generate Report
                    </a> -->
                    <!-- <a href="add_books.php" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Add Requests</span>
                    </a> -->
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Borrow Records</h6>
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
                                    $q = "SELECT users.name AS user_name, books.title AS book_name, transaction.* FROM `transaction` LEFT JOIN users ON transaction.user_id = users.id LEFT JOIN books ON transaction.book_id = books.id where transaction.is_approved != 2;";
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
                                                $datee = new DateTime($row['exptd_return_date']);
                                                echo $datee->format('j F, Y');
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if(!empty($row['return_date'])){
                                                    $datae = new DateTime($row['return_date']);
                                                    echo $datae->format('j F, Y');
                                                }else{ if($row['is_approved'] != 0){ ?>
                                                    <a class="btn btn-success" href="javascript:void(0)" data-toggle="modal" data-target="#myModal<?php echo $row['id']; ?>">Add Return Date</a>
                                                <?php
                                                }}
                                            ?>
                                        </td>
                                        <!-- <td><?php// echo $row['fine_amount']; ?></td>
                                        <td><?php //echo $row['fine_paid']; ?></td> -->
                                        <td>
                                        <?php if($row['is_approved'] == 1){ ?>
                                                <b class="text-success">Approved</b>
                                            <?php }elseif($row['is_approved'] == 0){ ?>
                                                <b class="text-danger">Canceled</b>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <div id="myModal<?php echo $row['id']; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <!-- <h4 class="modal-title">Modal Header</h4> -->
                                            </div>
                                            <div class="modal-body">
                                                <form action="edit_borrow_records.php" method="post">
                                                    <input type="hidden" name="tr_id" value="<?php echo $row['id']; ?>">
                                                    <div class="form-group">
                                                        <label for="authors">Return Date</label>
                                                        <input type="date" name="return_date" class="form-control" id="authors" placeholder="Enter date">
                                                    </div>
                                                    <button type="submit" name="get_book" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>

                                        </div>
                                    </div>
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
