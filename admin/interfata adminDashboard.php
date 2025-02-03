<?php
session_start();
include("connection.php");
include("urls.php");

// Query pentru traineri
$query = "SELECT COUNT(*) AS num_rows FROM traineritest";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$numTrainers = $row['num_rows'];

// Query pentru useri
$query2 = "SELECT COUNT(*) AS num_rows2 FROM useritest";
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_assoc($result2);
$numUsers = $row2['num_rows2'];

// Query pentru numărul total de exerciții
$query3 = "SELECT COUNT(*) as total_exercises FROM exercitii";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_assoc($result3);
$totalExercises = $row3['total_exercises'];

// Query pentru rating mediu din reviews
$query4 = "SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews FROM reviews";
$result4 = mysqli_query($con, $query4);
$row4 = mysqli_fetch_assoc($result4);
$avgRating = number_format($row4['avg_rating'], 1);
$totalReviews = $row4['total_reviews'];
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
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

	<style>
		.timeline {
			position: relative;
			padding-left: 1rem;
			margin: 1rem 0;
		}

		.timeline-item {
			position: relative;
			padding-left: 2rem;
			margin-bottom: 1rem;
		}

		.timeline-item-marker {
			position: absolute;
			left: 0;
			top: 0;
		}

		.timeline-item-marker-text {
			font-size: 0.8rem;
			color: #a7aeb8;
			margin-bottom: 0.25rem;
		}

		.timeline-item-marker-indicator {
			display: inline-block;
			width: 1rem;
			height: 1rem;
			border-radius: 100%;
			background-color: #007bff;
		}

		.text-warning {
			color: #ffc107 !important;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<div class="body-overlay"></div>

		<?php include 'menu.php'; ?>

		<div id="content">
			<!-- Top Navbar -->
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

					<!-- Breadcrumb -->
					<div class="xp-breadcrumbbar text-center">
						<h4 class="page-title">Dashboard</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Sculpted by GOD</a></li>
							<li class="breadcrumb-item active" aria-current="page">Admin</li>
						</ol>
					</div>
				</div>
			</div>

			<!-- Main Content -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- Cards Section -->
					<div class="row mt-4">
						<!-- Card Traineri -->
						<div class="col-xl-3 col-md-6">
							<div class="card bg-primary text-white mb-4">
								<div class="card-body">
									<span class="material-icons float-right">fitness_center</span>
									Numărul de Traineri
									<h4 class="mb-0"><?php echo $numTrainers; ?></h4>
								</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link" href="altTest.php">Vezi Trainerii</a>
									<div class="small text-white"><i class="material-icons">arrow_forward</i></div>
								</div>
							</div>
						</div>

						<!-- Card Useri -->
						<div class="col-xl-3 col-md-6">
							<div class="card bg-warning text-white mb-4">
								<div class="card-body">
									<span class="material-icons float-right">group</span>
									Numărul de Useri
									<h4 class="mb-0"><?php echo $numUsers; ?></h4>
								</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link" href="interfata adminUseri.php">Vezi
										Userii</a>
									<div class="small text-white"><i class="material-icons">arrow_forward</i></div>
								</div>
							</div>
						</div>

						<!-- Card Exerciții -->
						<div class="col-xl-3 col-md-6">
							<div class="card bg-success text-white mb-4">
								<div class="card-body">
									<span class="material-icons float-right">fitness_center</span>
									Exerciții Total
									<h4 class="mb-0"><?php echo $totalExercises; ?></h4>
								</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link" href="#">Vezi Exerciții</a>
									<div class="small text-white"><i class="material-icons">arrow_forward</i></div>
								</div>
							</div>
						</div>

						<!-- Card Reviews -->
						<div class="col-xl-3 col-md-6">
							<div class="card bg-info text-white mb-4">
								<div class="card-body">
									<span class="material-icons float-right">star</span>
									Rating Mediu (<?php echo $totalReviews; ?> reviews)
									<h4 class="mb-0"><?php echo $avgRating; ?>/5.0</h4>
								</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link" href="#">Vezi Reviews</a>
									<div class="small text-white"><i class="material-icons">arrow_forward</i></div>
								</div>
							</div>
						</div>
					</div>

					<!-- Grafice și Timeline -->
					<div class="row mt-4">
						<!-- Grafic pentru Activitate -->
						<div class="col-xl-8">
							<div class="card mb-4">
								<div class="card-header">
									<i class="material-icons align-middle">trending_up</i>
									Reviews Lunare
								</div>
								<div class="card-body">
									<canvas id="activityChart" width="100%" height="40"></canvas>
									<?php
									// Pregătim datele pentru reviews
									$last_6_months = array();
									$current_month = date('n');
									$current_year = date('Y');

									for ($i = 5; $i >= 0; $i--) {
										$month = $current_month - $i;
										$year = $current_year;
										if ($month <= 0) {
											$month += 12;
											$year--;
										}
										$last_6_months[] = array(
											'month' => $month,
											'year' => $year,
											'label' => date('M', mktime(0, 0, 0, $month, 1))
										);
									}

									// Query pentru reviews pe lună
									$reviews_data = array();
									$reviews_rating = array();
									foreach ($last_6_months as $month_data) {
										$month = $month_data['month'];
										$year = $month_data['year'];

										$query = "SELECT COUNT(*) as count, AVG(rating) as avg_rating 
                                                 FROM reviews 
                                                 WHERE MONTH(data_creare) = $month AND YEAR(data_creare) = $year";
										$result = mysqli_query($con, $query);
										$row = mysqli_fetch_assoc($result);
										$reviews_data[] = $row['count'];
										$reviews_rating[] = $row['avg_rating'] ? round($row['avg_rating'], 1) : 0;
									}

									$month_labels = array_column($last_6_months, 'label');
									?>
								</div>
							</div>
						</div>

						<!-- Timeline Activități -->
						<div class="col-xl-4">
							<div class="card mb-4">
								<div class="card-header">
									<i class="material-icons align-middle">update</i>
									Reviews Recente
								</div>
								<div class="card-body">
									<div class="timeline">
										<?php
										$activity_query = "SELECT r.data_creare, r.rating, r.comentariu,
                                                          r.user_id, r.exercitii_id
                                                   FROM reviews r
                                                   ORDER BY r.data_creare DESC LIMIT 5";

										$activity_result = mysqli_query($con, $activity_query);
										if ($activity_result && mysqli_num_rows($activity_result) > 0) {
											while ($activity = mysqli_fetch_assoc($activity_result)) {
												echo '<div class="timeline-item">';
												echo '<div class="timeline-item-marker">';
												echo '<div class="timeline-item-marker-text">' . date('d M H:i', strtotime($activity['data_creare'])) . '</div>';
												echo '<div class="timeline-item-marker-indicator bg-primary"></div>';
												echo '</div>';
												echo '<div class="timeline-item-content">';
												echo 'Review nou pentru exercițiul #' . $activity['exercitii_id'] . '<br>';
												echo '<span class="text-warning">' . str_repeat('★', $activity['rating']) . '</span>';
												if ($activity['comentariu']) {
													echo '<br><small class="text-muted">"' . htmlspecialchars(substr($activity['comentariu'], 0, 50)) . '..."</small>';
												}
												echo '</div>';
												echo '</div>';
											}
										} else {
											echo '<div class="timeline-item">Nu există reviews recente.</div>';
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="js/admin/jquery-3.3.1.slim.min.js"></script>
	<script src="js/admin/popper.min.js"></script>
	<script src="js/admin/bootstrap.min.js"></script>
	<script src="js/admin/jquery-3.3.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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


	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var ctx = document.getElementById('activityChart');
			new Chart(ctx, {
				type: 'line',
				data: {
					labels: <?php echo json_encode($month_labels); ?>,
					datasets: [{
						label: 'Număr Reviews',
						data: <?php echo json_encode($reviews_data); ?>,
						borderColor: 'rgba(0, 123, 255, 1)',
						tension: 0.1,
						yAxisID: 'y'
					}, {
						label: 'Rating Mediu',
						data: <?php echo json_encode($reviews_rating); ?>,
						borderColor: 'rgba(40, 167, 69, 1)',
						tension: 0.1,
						yAxisID: 'y1'
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					scales: {
						y: {
							beginAtZero: true,
							position: 'left',
							title: {
								display: true,
								text: 'Număr Reviews'
							}
						},
						y1: {
							beginAtZero: true,
							position: 'right',
							max: 5,
							title: {
								display: true,
								text: 'Rating Mediu'
							}
						}
					},
					plugins: {
						legend: {
							position: 'top'
						},
						tooltip: {
							mode: 'index',
							intersect: false
						}
					}
				}
			});
		});
	</script>
</body>

</html>