<?php 
    include('../db_connect.php');
    include('admin_includes/header.php'); 

    if(isset($_POST['register'])){      
        $name = $_POST['name'];        
        $email = $_POST['email'];        
        $mobile = $_POST['mobile'];        
        $city = $_POST['city'];        
        $address = $_POST['address'];       
        $password = password_hash($_POST['passwd'],PASSWORD_DEFAULT); 

        $q = "SELECT * FROM users WHERE email = '$email'";
        $res = $conn->query($q);
        if($res->num_rows > 0){
            echo "already have the email";
        }else{
            $q = "INSERT INTO users SET name = '$name', role = 'user', email = '$email', mobile = '$mobile', city = '$city', address = '$address', password = '$password'";
            $res = $conn->query($q);
            // if($res->num_rows > 0){
            //     $row = $res->fetch_assoc();
            //     $_SESSION['admin_name'] = $row['name'];
            //     $_SESSION['admin_id'] = $row['id'];
            //     header("location:dashbord.php");
            // }else{
            //     $error = "Invalid email and password";
            // }
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
                    <h1 class="h3 mb-0 text-gray-800">Add Users</h1>
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i>Generate Report
                    </a> -->
                    <a href="users.php" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Back</span>
                    </a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add Users</h6>
                    </div>
                    <div class="card-body">
                        <form id="signupform" class="form-horizontal" action="" method="post">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-3 control-label">Name</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" class="form-control" name="name" placeholder="First Name" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-3 control-label">Email</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" class="form-control" name="email" placeholder="Email Address" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-3 control-label">Mobile Number</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-3 control-label">City</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" class="form-control" name="city" placeholder="Your City" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-3 control-label">Address</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <textarea name="address" class="form-control" placeholder="Address Detatils" id="" cols="3" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-3 control-label">Password</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input type="password" class="form-control" name="passwd" placeholder="Password" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- Button -->
                                    <div class="signup-btn">
                                        <button id="btn-signup" type="submit" name="register" class="btn btn-primary">
                                            Submit</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>

                </div>
                <!-- /.container-fluid -->

                </div>
            <!-- End of Main Content -->

            <?php include('admin_includes/footer.php'); ?>
