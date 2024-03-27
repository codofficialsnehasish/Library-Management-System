<?php 
    include('../db_connect.php');
    $ID = $_GET['id'];
    include('admin_includes/header.php'); 

    if(isset($_POST['add_book'])){      
        $title = $_POST['title'];        
        $authors = $_POST['authors'];        
        $isbn = $_POST['isbn'];        
        $publisher = $_POST['publisher'];        
        $publicatrion_year = $_POST['publicatrion_year'];       
        $category = $_POST['category'];       
        $description = $_POST['description'];       
        $language = $_POST['language'];       
        $total_copies = $_POST['total_copies'];       
        $avaliable_copies = $_POST['avaliable_copies'];       
        $location = $_POST['location'];       
        $keywords = $_POST['keywords'];        
        if(isset($_FILES['img'])){
            $buffer = $_FILES['img']['tmp_name'];
            $imgname = time().$_FILES['img']['name'];
            move_uploaded_file($buffer,"../book_img/".$imgname);
        }

        $qu = "UPDATE books SET title = '$title', author = '$authors', isbn = '$isbn', publisher = '$publisher', publication_year = '$publicatrion_year', category = '$category', description = '$description', language = '$language', total_copies = '$total_copies', avaliable_copies = '$avaliable_copies', shelf_number = '$location', keywords = '$keywords', image = '$imgname' WHERE id = '$ID'";
        $ress = $conn->query($qu);
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
                    <h1 class="h3 mb-0 text-gray-800">Edit Books</h1>
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i>Generate Report
                    </a> -->
                    <a href="books.php" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Back</span>
                    </a>
                </div>

                <!-- DataTales Example -->
                <?php
                    $q = "SELECT * FROM books WHERE id='$ID'";
                    $res = $conn->query($q);
                    $row = $res->fetch_assoc();
                ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Books</h6>
                    </div>
                    <div class="card-body">
<form action="" method="post"  enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" name="title" value="<?php echo $row['title'] ?>" class="form-control" id="title" placeholder="Enter title">
    </div>
    <div class="form-group">
      <label for="authors">Author(s):</label>
      <input type="text" name="authors" value="<?php echo $row['author'] ?>" class="form-control" id="authors" placeholder="Enter author(s)">
    </div>
    <div class="form-group">
      <label for="isbn">ISBN:</label>
      <input type="text" name="isbn" value="<?php echo $row['isbn'] ?>" class="form-control" id="isbn" placeholder="Enter ISBN">
    </div>
    <div class="form-group">
      <label for="publisher">Publisher:</label>
      <input type="text" name="publisher" value="<?php echo $row['publisher'] ?>" class="form-control" id="publisher" placeholder="Enter publisher">
    </div>
    <div class="form-group">
      <label for="publicationYear">Publication Year:</label>
      <input type="text" name="publicatrion_year" value="<?php echo $row['publication_year'] ?>" class="form-control" id="publicationYear" placeholder="Enter publication year">
    </div>
    <div class="form-group">
      <label for="genre">Genre/Category:</label>
      <input type="text" name="category" value="<?php echo $row['category'] ?>" class="form-control" id="genre" placeholder="Enter genre/category">
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"><?php echo $row['description'] ?></textarea>
    </div>
    <div class="form-group">
      <label for="language">Language:</label>
      <input type="text" name="language" value="<?php echo $row['language'] ?>" class="form-control" id="language" placeholder="Enter language">
    </div>
    <div class="form-group">
      <label for="totalCopies">Total Copies:</label>
      <input type="number" name="total_copies" value="<?php echo $row['total_copies'] ?>" class="form-control" id="totalCopies" placeholder="Enter total copies">
    </div>
    <div class="form-group">
      <label for="availableCopies">Available Copies:</label>
      <input type="number" name="avaliable_copies" value="<?php echo $row['avaliable_copies'] ?>" class="form-control" id="availableCopies" placeholder="Enter available copies">
    </div>
    <div class="form-group">
      <label for="location">Location/Shelf number:</label>
      <input type="text" name="location" value="<?php echo $row['shelf_number'] ?>" class="form-control" id="location" placeholder="Enter location/shelf number">
    </div>
    <div class="form-group">
      <label for="keywords">Keywords/Tags:</label>
      <input type="text" name="keywords" value="<?php echo $row['keywords'] ?>" class="form-control" id="keywords" placeholder="Enter keywords/tags">
    </div>
    <div class="form-group">
      <label for="coverImage">Cover Image:</label>
      <img src="../book_img/<?php echo $row['image']; ?>" width="100px;" alt="">
      <input type="file" name="img" class="form-control-file" id="coverImage">
    </div>
    <button type="submit" name="add_book" class="btn btn-primary">Submit</button>
  </form>
  </div>
                </div>

                </div>
                <!-- /.container-fluid -->

                </div>
            <!-- End of Main Content -->

            <?php include('admin_includes/footer.php'); ?>
