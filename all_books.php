<?php 
	include('site_include/header.php'); 
	include("db_connect.php");

	if(isset($_POST['get_book'])){      
        $user_id = $_POST['user_id'];        
        $product_id = $_POST['product_id']; 
		$borrow_date = date("Y-m-d");
		$currentDate = new DateTime();
		$currentDate->modify('+10 days');
		$formattedDate = $currentDate->format('Y-m-d');

        $q = "SELECT avaliable_copies FROM books WHERE id = '$product_id'";
        $res = $conn->query($q);
		$row = $res->fetch_assoc();
        if($row['avaliable_copies'] < 1){
            $error = "Not Enough Copies Avaliable";
        }else{
            $q = "INSERT INTO transaction SET user_id = '$user_id', book_id = '$product_id', borrow_date = '$borrow_date', exptd_return_date = '$formattedDate'";
            $res = $conn->query($q);
            $success = "Book Borrow Request Successfull";
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
					<h2 class="title-inner">
						world of reading
					</h2>

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
							<a href="all_books.php">Books catalogue</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!--//breadcrumbs ends here-->
		<!-- Shop -->
		<div class="innerf-pages section">
			<div class="container-cart">
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
				<!-- product right -->
				<div class="left-ads-display col-md-12">
					<div class="wrapper_top_shop">
						<!-- product-sec1 -->
						<div class="product-sec1">
							<?php
								if(isset($_POST['search'])) {
									$search = $_POST['search'];
									// SQL query to search for books
									$sql = "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%' OR category LIKE '%$search%' OR keywords LIKE '%$search%'";
									$result = $conn->query($sql);
								
									if ($result->num_rows > 0) {
										// Output data of each row
										while($row = $result->fetch_assoc()) { ?>
											<div class="col-md-3 product-men">
												<div class="product-chr-info chr">
													<div class="thumbnail">
														<a href="javascript:void(0)">
															<img src="book_img/<?php echo $row['image']; ?>" alt="">
														</a>
													</div>
													<div class="caption">
														<h4><?php echo $row['title']; ?></h4>
														<p><?php echo $row['author']; ?></p>
														<div class="matrlf-mid">

															<div class="clearfix"> </div>
														</div>
														<?php if (isset($_SESSION['id'])) { ?>
														<form action="" method="post">
															<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
															<input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
															<div style="display: flex;gap: 5px;">
																<button type="submit" name="get_book" class="chr-cart pchr-cart">Get Book
																	<i class="fa fa-book" aria-hidden="true" style="margin: 0;"></i>
																</button>
																<button type="button" class="chr-cart pchr-cart" data-toggle="modal" data-target="#mysModal<?php echo $row['id']; ?>">Details</button>
															</div>
														</form>
														<?php }else{ ?>
														<button onclick="window.location.href='login.php';" class="chr-cart pchr-cart">Get Book
															<i class="fa fa-book" aria-hidden="true"></i>
														</button>
														<?php } ?>
													</div>
												</div>
											</div>
											<div id="mysModal<?php echo $row['id']; ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Book Details</h4>
														</div>
														<div class="modal-body">
															<div class="container-fluid">
																<div class="row">
																	<div class="col-md-4">
																		<img src="book_img/<?php echo $row['image']; ?>" class="img-fluid" alt="Book Cover" width="100px">
																	</div>
																	<div class="col-md-8">
																		<h5>Title: <?php echo $row['title']; ?></h5>
																		<p>Author: <?php echo $row['author']; ?></p>
																		<p>ISBN: <?php echo $row['isbn']; ?></p>
																		<p>Publication: <?php echo $row['publisher']; ?></p>
																		<p>Publication Year: <?php echo $row['publication_year']; ?></p>
																		<p>Category: <?php echo $row['category']; ?></p>
																		<p>Description: <?php echo $row['description']; ?></p>
																		<p>Language: <?php echo $row['language']; ?></p>
																		<p>Keywords: <?php echo $row['keywords']; ?></p>
																		<p>Total Copies: <strong><?php echo $row['total_copies']; ?></strong></p>
																		<p>Available Copies: <strong><?php echo $row['avaliable_copies']; ?></strong></p>
																	</div>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
										<?php }
									} else {
										echo "No results found";
									}
								}else{
								$q = "SELECT * FROM books";
								$res = $conn->query($q);
								while ($rows = $res->fetch_assoc()) { ?>
							<div class="col-md-3 product-men">
								<div class="product-chr-info chr">
									<div class="thumbnail">
										<a href="javascript:void(0)">
											<img src="book_img/<?php echo $rows['image']; ?>" alt="">
										</a>
									</div>
									<div class="caption">
										<h4><?php echo $rows['title']; ?></h4>
										<p><?php echo $rows['author']; ?></p>
										<div class="matrlf-mid">

											<div class="clearfix"> </div>
										</div>
										<?php if (isset($_SESSION['id'])) { ?>
										<form action="" method="post">
											<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
											<input type="hidden" name="product_id" value="<?php echo $rows['id']; ?>">
											<div style="display: flex;gap: 5px;">
												<button type="submit" name="get_book" class="chr-cart pchr-cart">Get Book
													<i class="fa fa-book" aria-hidden="true" style="margin: 0;"></i>
												</button>
												<button type="button" class="chr-cart pchr-cart" data-toggle="modal" data-target="#mysModal<?php echo $rows['id']; ?>">Details</button>
											</div>
										</form>
										<?php }else{ ?>
										<div style="display: flex;gap: 5px;">
											<button onclick="window.location.href='login.php';" class="chr-cart pchr-cart">Get Book
												<i class="fa fa-book" aria-hidden="true" style="margin: 0;"></i>
											</button>
											<button type="button" class="chr-cart pchr-cart" data-toggle="modal" data-target="#mysModal<?php echo $rows['id']; ?>">Details</button>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<div id="mysModal<?php echo $rows['id']; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Book Details</h4>
										</div>
										<div class="modal-body">
											<div class="container-fluid">
												<div class="row">
													<div class="col-md-4">
														<img src="book_img/<?php echo $rows['image']; ?>" class="img-fluid" alt="Book Cover" width="100px">
													</div>
													<div class="col-md-8">
														<h5>Title: <?php echo $rows['title']; ?></h5>
														<p>Author: <?php echo $rows['author']; ?></p>
														<p>ISBN: <?php echo $rows['isbn']; ?></p>
														<p>Publication: <?php echo $rows['publisher']; ?></p>
														<p>Publication Year: <?php echo $rows['publication_year']; ?></p>
														<p>Category: <?php echo $rows['category']; ?></p>
														<p>Description: <?php echo $rows['description']; ?></p>
														<p>Language: <?php echo $rows['language']; ?></p>
														<p>Keywords: <?php echo $rows['keywords']; ?></p>
														<p>Total Copies: <strong><?php echo $rows['total_copies']; ?></strong></p>
														<p>Available Copies: <strong><?php echo $rows['avaliable_copies']; ?></strong></p>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
							<?php
								}}
							?>
							<div class="clearfix"></div>

						</div>

						<!-- //product-sec1 -->
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>

			</div>
		</div>
		<!--// Shop -->
        <?php include('site_include/footer.php'); ?>