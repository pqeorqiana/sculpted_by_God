<?php
include("connection.php");
include 'urls.php'
	?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title>Sculpted By God</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!----css3---->
	<link rel="stylesheet" href="../css/styleAdDashboard.css">


	<!--google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">


	<!--google material icon-->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

</head>

<body>



	<div class="wrapper">

		<div class="body-overlay"></div>

		<!-------sidebar--design------------>

		<?php include 'menu.php'; ?>


		<!-------sidebar--design- close----------->



		<!-------page-content start----------->

		<div id="content">

			<!------top-navbar-start----------->

			<div class="top-navbar">
				<div class="xd-topbar">
					<div class="row">
						<div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
							<div class="xp-menubar">
								<span class="material-icons text-white">signal_cellular_alt</span>
							</div>
						</div>

						<div class="col-md-5 col-lg-3 order-3 order-md-2">
						</div>

						<div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
							<div class="xp-profilebar text-right">
								<nav class="navbar p-0">
									<ul class="nav navbar-nav flex-row ml-auto">
										<li class="dropdown nav-item">
											<a class="nav-link" href="#" data-toggle="dropdown">
												<img src="img/user.jpg" style="width:40px; border-radius:50%;" />
												<span class="xp-user-live"></span>
											</a>
											<ul class="dropdown-menu small-menu">
												<li>
													<a href="<?php echo $urls['profile']; ?>">
														<span class="material-icons">person_outline</span>
														Profile
													</a>
												</li>
												<li>
													<a href="<?php echo $urls['logout']; ?>">
														<span class="material-icons">logout</span>
														Logout
													</a>
												</li>
											</ul>
										</li>
									</ul>
								</nav>
							</div>
						</div>

					</div>

					<div class="xp-breadcrumbbar text-center">
						<h4 class="page-title">Dashboard</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Sculpted by GOD</a></li>
							<li class="breadcrumb-item active" aria-curent="page">Trainer</li>
						</ol>
					</div>


				</div>
			</div>
			<!------top-navbar-end----------->
			<div id="layoutSidenav_content">
				<main>
					<div class="container-fluid px-4">
						<h1 class="mt-4"></h1>

						<div class="row">
							<div class="col-xl-3 col-md-6">
								<div class="card bg-primary text-white mb-4">
									<div class="card-body">
										Numarul de Traineri
										<h4 class="mb-0">
											<?php
											$query = "SELECT COUNT(*) AS num_rows FROM traineritest";
											$result = mysqli_query($con, $query);
											$row = mysqli_fetch_assoc($result);
											$numTrainers = $row['num_rows'];
											echo $numTrainers; ?>
										</h4>
									</div>



									<div class="card-footer d-flex align-items-center justify-content-between">
										<a class="small text-white stretched-link" href="#">View Details</a>
										<div class="small text-white"><i class="fas fa-angle-right"></i></div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-md-6">
								<div class="card bg-warning text-white mb-4">
									<div class="card-body">Numarul de useri <h4 class="mb-0">
											<?php
											$query2 = "SELECT COUNT(*) AS num_rows2 FROM useritest";
											$result2 = mysqli_query($con, $query2);
											$row2 = mysqli_fetch_assoc($result2);
											$numUsers = $row2['num_rows2'];
											echo $numUsers; ?>
										</h4>
									</div>

									<div class="card-footer d-flex align-items-center justify-content-between">
										<a class="small text-white stretched-link" href="#">View Details</a>
										<div class="small text-white"><i class="fas fa-angle-right"></i></div>
									</div>
								</div>
							</div>

							<div class="col-xl-3 col-md-6">
								<div class="card bg-danger text-white mb-4">
									<div class="card-body">Numarul de antrenamente<h4 class="mb-0">
											<?php
											$query2 = "SELECT COUNT(*) AS num_rows2 FROM exercitii";
											$result2 = mysqli_query($con, $query2);
											$row2 = mysqli_fetch_assoc($result2);
											$numUsers = $row2['num_rows2'];
											echo $numUsers; ?>
										</h4>
									</div>
									<div class="card-footer d-flex align-items-center justify-content-between">
										<a class="small text-white stretched-link" href="#">View Details</a>
										<div class="small text-white"><i class="fas fa-angle-right"></i></div>
									</div>
								</div>
							</div>
						</div>


					</div>
				</main>

			</div>

		</div>


		<!-------complete html----------->






		<!-- Optional JavaScript -->
		<script src="js/admin/jquery-3.3.1.slim.min.js"></script>
		<script src="js/admin/popper.min.js"></script>
		<script src="js/admin/bootstrap.min.js"></script>
		<script src="js/admin/jquery-3.3.1.min.js"></script>


		<script type="text/javascript">
			$(document).ready(function () {
				$(".xp-menubar").on('click', function () {
					$("#sidebar").toggleClass('active');
					$("#content").toggleClass('active');
				});

				$('.xp-menubar,.body-overlay').on('click', function () {
					$("#sidebar,.body-overlay").toggleClass('show-nav');
				});

			});
		</script>





</body>

</html>