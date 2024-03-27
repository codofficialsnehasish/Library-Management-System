<?php
    include('site_include/header.php');
    include("db_connect.php");
    if(!isset($_SESSION['user_id'])){
        header("location: login.php");
    }
    if(isset($_POST['change_password'])){      
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $iid = $_SESSION['user_id'];
        $qu = "UPDATE users SET password = '$password' WHERE id = '$iid'";
        $ress = $conn->query($qu);
        session_destroy();
        header("location:login.php");
    }  
?>



<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php include('site_include/navbar.php'); ?>
        <!-- banner -->
        <div class="banner-bg-inner">
            <!-- banner-text -->
            <div class="banner-text-inner">
                <div class="container">
                    <h2 class="title-inner">world of reading</h2>
                </div>
            </div>
            <!-- //banner-text -->
        </div>
        <!-- //banner -->
        <!-- breadcrumbs -->
        <div class="crumbs text-center">
            <div class="container">
                <div class="row">
                    <ul class="btn-group btn-breadcrumb bc-list">
                        <li class="btn btn1">
                            <a href="index.php">
                                <i class="glyphicon glyphicon-home"></i>
                            </a>
                        </li>
                        <li class="btn btn2">
                            <a href="forget_password.php">Forget Password</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--//breadcrumbs ends here-->
        <!-- signin and signup form -->
        <div class="login-form section text-center">
            <div class="container">
                <?php if(isset($error)){ ?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Danger!</strong> <?php echo $error; ?>
                </div>
                <?php } ?>
                <?php if(isset($success)){ ?>
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> <?php echo $success; ?>
                </div>
                <?php } ?>
                <div style="margin-top:30px;" class="mainbox  loginbox">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Chanage Password</div>
                        </div>
                        <div style="padding-top:30px" class="panel-body">
                            <h5 style="padding-bottom:10px;">Hello, <?php echo $_SESSION['user_name'] ?></h5>
                            <form id="loginform" class="form-horizontal" action="" method="post">
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </span>
                                    <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required="">
                                </div>
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls">
                                        <button type="submit" id="btn-login" name="change_password" class="btn btn-success">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--//signin and signup form ends here-->
    <?php include('site_include/footer.php'); ?>