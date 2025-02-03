<?php
include 'connection.php';
include 'urls.php';

$id = $_GET['updateid'];
$sql = "select * from `exercitii` where id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$nume = $row['nume'];
$descriere = $row['descriere'];
$utilitate = $row['utilitate'];
$demonstrare = $row['demonstrare'];


if (isset($_POST['submit'])) {
	$nume = $_POST['nume'];
	$descriere = $_POST['descriere'];
	$utilitate = $_POST['utilitate'];
	$demonstrare = $_POST['demonstrare'];

	$sql = "update `exercitii` set id=$id, nume='$nume',descriere='$descriere',utilitate='$utilitate',demonstrare='$demonstrare' where id=$id";
	$result = mysqli_query($con, $sql);
	if ($result) {
		header('location:antrenament.php');
	} else {
		die(mysqli_error($con));
	}
}


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
	<link rel="stylesheet" href="../css/custom.css">


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
							<div class="xp-searchbar">
								<form>
									<div class="input-group">
										<input type="search" class="form-control" placeholder="Search">
										<div class="input-group-append">
											<button class="btn" type="submit" id="button-addon2">Cauta
											</button>
										</div>
									</div>
								</form>
							</div>
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
						<h4 class="page-title">Traineri</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Sculpted by GOD</a></li>
							<li class="breadcrumb-item active" aria-curent="page">Admin</li>
						</ol>
					</div>


				</div>
			</div>
			<!------top-navbar-end----------->


			<!------main-content-start----------->

			<div class="main-content">
				<div class="row">
					<div class="col-md-12">
						<div class="table-wrapper">

							<div class="table-title">
								<div class="row">
									<div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
										<h2 class="ml-lg-2">Editare Traineri</h2>
									</div>

								</div>
							</div>

							<div class="container my-5">
								<form method="post">
									<div class="form-group">
										<label>Nume</label>
										<input type="text" class="form-control" placeholder="Introdu numele" name="nume"
											autocomplete="off" value=<?php echo $nume; ?>>
									</div>
									<div class="form-group">
										<label>Descriere</label>
										<input type="text" class="form-control" placeholder="Introdu descrierea"
											name="descriere" autocomplete="off" value=<?php echo $descriere; ?>>
									</div>
									<div class="form-group">
										<label>Utilitate</label>
										<input type="text" class="form-control" placeholder="Ce grupa de muschi ajuta?"
											name="utilitate" autocomplete="off" value=<?php echo $utilitate; ?>>
									</div>
									<div class="form-group">
										<label>Adauga din nou acest tip de exercitiu</label>
										<?php
										if (!empty($demonstrare)) {
											echo '<img src="css/' . $demonstrare . '" width="200" height="200" alt="Demonstrare">';
										}
										?>
										<input type="file" class="form-control" name="demonstrare">
									</div>





									<button type="submit" class="btn btn-primary" name="submit">Update</button>
									<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
										<a href="antrenament.php" class="btn btn-success">

											<span>Back</span>
										</a>

									</div>
								</form>

							</div>



						</div>


					</div>
				</div>




				<!----edit-modal end--------->

			</div>
		</div>

		<!------main-content-end----------->







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