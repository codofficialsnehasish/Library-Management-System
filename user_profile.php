<?php 
    include('site_include/header.php');
    include("db_connect.php"); 
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }
    ?>
    <style>
        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .gcontainer {
            /* max-width: 800px; */
            margin: 80px auto;
            padding: 20px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-bottom: 1px solid #007bff;
            border-radius: 5px 5px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            display: inline-block;
            background-color: #343a40;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #555;
        }
    </style>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<div id="home">
		<!-- header -->
		<?php include('site_include/navbar.php'); ?>
        <div class="gcontainer">
        <div class="card">
            <div class="card-header">
                <h1>Welcome, <?php echo $_SESSION['name']; ?>!</h1>
            </div>
            <?php
                $id = $_SESSION['id'];
                $q = "SELECT * FROM users WHERE id = '$id'";
                $res = $conn->query($q);
                $row = $res->fetch_assoc();
            ?>
            <div class="card-body">
                <h2>Member Information</h2>
                <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                <!-- <p><strong>Membership Status:</strong> [Membership Status]</p> -->
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Borrowing History</h2>
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Borrow Date</th>
                            <th>Expected Return Date</th>
                            <th>Actual Return Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Borrowing history entries will be dynamically generated here -->
                        <?php
                            // $q = "SELECT * FROM users where role != 'admin'";
                            $user = $row['id'];
                            $q = "SELECT books.title AS book_name, transaction.* FROM `transaction` LEFT JOIN books ON transaction.book_id = books.id where transaction.user_id = $user;";
                            $ress = $conn->query($q);
                            while ($rows = $ress->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $rows['book_name']; ?></td>
                            <td><?php echo $rows['borrow_date']; ?></td>
                            <td>
                                <?php echo $rows['exptd_return_date']; ?>
                            </td>
                            <td>
                                <?php 
                                    if(!empty($rows['return_date'])){
                                        echo $rows['return_date'];
                                    }else{
                                        echo '<b class="text-danger">Not Returned</b>';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php if($rows['is_approved'] == 1){ ?>
                                    <b class="text-success">Approved</b>
                                <?php }elseif($rows['is_approved'] == 0){ ?>
                                    <b class="text-danger">Canceled</b>
                                <?php }else{ ?>
                                    <b class="text-warning">Pending</b>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- <div class="card">
            <div class="card-header">
                <h2>Account Status</h2>
            </div>
            <div class="card-body">
                <p><strong>Total Fine Amount:</strong> [Total Fine Amount]</p>
                <a href="#" class="btn btn-danger">Pay Fine</a>
            </div>
        </div> -->

        <!-- <div class="card">
            <div class="card-header">
                <h2>Update Information</h2>
            </div>
            <div class="card-body">
                <form>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="[Member Email]" required>
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div> -->

        <div class="card">
            <div class="card-body">
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </div>

    <?php include('site_include/footer.php'); ?>
