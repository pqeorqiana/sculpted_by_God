<?php
include 'connection.php';
include 'urls.php';

$start = 0;
$limit = 2;
$id = 1;

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$start = ($id - 1) * $limit;
}

$sql = "SELECT * FROM `traineritest` LIMIT $start, $limit";
$result = mysqli_query($con, $sql);

$total_pages_sql = "SELECT COUNT(*) as count FROM `traineritest`";
$total_pages_result = mysqli_query($con, $total_pages_sql);
$total_rows = mysqli_fetch_assoc($total_pages_result)['count'];
$total_pages = ceil($total_rows / $limit);
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
										<h2 class="ml-lg-2">Lista Traineri</h2>
									</div>
									<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
										<a href="altTest2.php" class="btn btn-success">
											<i class="material-icons">&#xE147;</i>
											<span>Adauga un trainer nou</span>
										</a>
									</div>
								</div>
							</div>

							<div class="container">
								<table class="table">
									<thead>
										<tr>
											<th scope="col"><b>ID</b></th>
											<th scope="col"><b>Nume</b></th>
											<th scope="col"><b>Email</b></th>
											<th scope="col"><b>Numar telefon</b></th>
											<th scope="col"><b>Parola</b></th>
											<th scope="col"><b>Operatii</b></th>
										</tr>
									</thead>
									<tbody>
										<?php
										if ($result) {
											while ($row = mysqli_fetch_assoc($result)) {
												$id = $row['id'];
												$nume = $row['nume'];
												$email = $row['email'];
												$numartel = $row['numartel'];
												$parola = $row['parola'];
												echo '<tr>
                                    <th scope="row">' . $id . '</th>
                                    <td>' . $nume . '</td>
                                    <td>' . $email . '</td>
                                    <td>' . $numartel . '</td>
                                    <td>' . $parola . '</td>
                                    <td>
                                        <button class="btn btn-primary">
                                            <a href="updateTestPHP.php?updateid=' . $id . '" class="text-light">Update</a>
                                        </button>
                                        <button class="btn btn-danger">
                                            <a href="testAdInc.php?deleteid=' . $id . '" class="text-light">Sterge</a>
                                        </button>
                                    </td>
                                </tr>';
											}
										}
										?>
									</tbody>
								</table>
							</div>

						</div>

						<!-- Pagination -->
						<nav aria-label="Page navigation">
							<ul class="pagination">
								<?php
								for ($i = 1; $i <= $total_pages; $i++) {
									$active = ($i == $id) ? "active" : "";
									echo '<li class="page-item ' . $active . '"><a class="page-link" href="?id=' . $i . '">' . $i . '</a></li>';
								}
								?>
							</ul>
						</nav>
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