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
                    <h1 class="h3 mb-0 text-gray-800">Books</h1>
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i>Generate Report
                    </a> -->
                    <a href="add_books.php" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Add Books</span>
                    </a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Books Table</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Authors Name</th>
                                        <th>ISBN</th>
                                        <th>Publisher</th>
                                        <th>Publication Year</th>
                                        <th>Genre/Category</th>
                                        <th>Description</th>
                                        <th>Language</th>
                                        <th>Total Copies</th>
                                        <th>Available Copies</th>
                                        <th>Location/Shelf number</th>
                                        <th>Keywords/Tags</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    // $q = "SELECT * FROM users where role != 'admin'";
                                    $q = "SELECT * FROM books ";
                                    $res = $conn->query($q);
                                    while ($row = $res->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><img src="../book_img/<?php echo $row['image']; ?>" alt="" width="50px;"> <?php echo $row['title']; ?></td>
                                        <td><?php echo $row['author']; ?></td>
                                        <td><?php echo $row['isbn']; ?></td>
                                        <td><?php echo $row['publisher']; ?></td>
                                        <td><?php echo $row['publication_year']; ?></td>
                                        <td><?php echo $row['category']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td><?php echo $row['language']; ?></td>
                                        <td><?php echo $row['total_copies']; ?></td>
                                        <td><?php echo $row['avaliable_copies']; ?></td>
                                        <td><?php echo $row['shelf_number']; ?></td>
                                        <td><?php echo $row['keywords']; ?></td>
                                        <td>
                                            <a class="btn btn-danger" onclick = "confirm('Are you sure?')" href="delete_books.php?id=<?php echo $row['id']; ?>">Delete</a>
                                            <a class="btn btn-success" href="edit_book.php?id=<?php echo $row['id'];?>">Edit</a>
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
