<?php
    include('site_include/header.php');
    include("db_connect.php");
    if(isset($_POST['log'])){      
        $email = $_POST['email'];        
        $password = $_POST['password'];   
        
        $q = "SELECT * FROM users WHERE email = '$email'";
        $res = $conn->query($q);
        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
            if(password_verify($password,$row['password'])){
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                if($row['role'] == "admin"){
                    header("location:admin/index.php");
                }else{
                    header("location:user_profile.php");
                }
            }else{
                $error = "Password Not Matched";
            }
        }else{
            $error = "Invalid email and password";
        }
    }  

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
            $error = "Already Have The Email, Try With Different";
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
            $success = "Successfully Registered";
        }
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
                            <a href="login.php">sign in & sign up</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--//breadcrumbs ends here-->
        <!-- signin and signup form -->
        <div class="login-form section text-center">
            <div class="container">
                <h4 class="rad-txt">
                    <span class="abtxt1">Sign in</span>
                    <span class="abtext">sign up</span>
                </h4>
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
                <div id="loginbox" style="margin-top:30px;" class="mainbox  loginbox">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign In</div>
                            <div class="fpassword">
                                <a href="forget_password.php">Forgot password?</a>
                            </div>
                        </div>
                        <div style="padding-top:30px" class="panel-body">
                            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            <form id="loginform" class="form-horizontal" action="" method="post">
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>
                                    <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="email id" required="">
                                </div>

                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </span>
                                    <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required="">
                                </div>
                                <!-- <div class="input-group">
                                    <div class="checkbox">
                                        <label>
                                            <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                    </div>
                                </div> -->
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls">
                                        <button type="submit" id="btn-login" name="log" class="btn btn-success">Login</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                            Don't have an account!
                                            <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                                Sign Up Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="signupbox" style="display:none; margin-top:50px" class="mainbox loginbox">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px">
                                <a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form id="signupform" class="form-horizontal" action="#" method="post">
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
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
                                        <button id="btn-signup" type="submit" name="register" class="btn btn-info">
                                            <i class="icon-hand-right"></i> &nbsp; Sign Up</button>
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