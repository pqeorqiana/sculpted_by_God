<?php
require 'connection.php';

$query = "SELECT * FROM menu_items";
$query_run = mysqli_query($con, $query);
$check = mysqli_num_rows($query_run) > 0;
$menu_items = array();

if ($check) {
	while ($row = mysqli_fetch_assoc($query_run)) {
		$menu_items[] = $row;
	}
} else {
	echo "No menu items found.";
}


?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
	<title>Sculpted By God</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/styleLog.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
	<link rel="icon" href="img/icon.png">
</head>

<body>
	<!----------------------------------------logo si bara de navigare---------------------------------->
	<div class="navbar">
		<a href="http://localhost/testareProiect2/Foundation-Sites-CSS/testTraining2.php" class="logo">S<B>God</B>.</a>
		<div class="toggle" onclick="navToggle();"></div>
		<ol>

			<?php
			foreach ($menu_items as $item) {
				$id = $item['id'];
				$title = $item['title'];
				$link = $item['link'];

				echo '<li><a href="' . $link . '" onclick="navToggle();">' . $title . '</a></li>';
			}
			?>
		</ol>
	</div>

	<!-----------------------------------------------login si register-------------------------------->
	<style>
		.custom-select {
			background-color: black;
			color: grey;
			margin-bottom: 10px;
		}
	</style>
	<div class="modificare">
		<div class="form-box">
			<div class="button-box">
				<div id="btn"></div>
				<button type="button" class="toggle-btn" onclick="login()">Log in</button>
				<button type="button" class="toggle-btn" onclick="register()">Register</button>
			</div>



			<form id="login" action="loginare.php" method="post" class="input-group">
				<select name="user_type" class="custom-select form-select">
					<option value="admin">Admin</option>
					<option value="user">User</option>
					<option value="trainer">Trainer</option>
				</select>

				<input type="text" class="input-field" placeholder="Nume" name="nume" id="nume" required
					autocomplete="off">
				<input type="password" class="input-field" placeholder="Parola" name="parola" id="parola" required
					autocomplete="off">
				<input type="checkbox" class="check-box"><span>Tine minte parola</span>
				<button type="submit" class="submit-btn" name="submit">Logare</button>
			</form>


		</div>
	</div>


	<script>
		function register() {
			window.location.href = "http://localhost/testareProiect2/Foundation-Sites-CSS/inregistrare.php";
		}
	</script>


	<!---------------------------------------------javascript------------------------------------------------->
	<script>
		window.addEventListener('scroll', function () {
			const navbar = document.querySelector('.navbar');
			navbar.classList.toggle("sticky", window.scrollY > 50);
		})
		const togglebar = document.querySelector('.toggle');
		const menu = document.querySelector('.ol');


		function navToggle() {
			var navList = document.querySelector('.navbar ol');
			navList.classList.toggle("active");
			togglebar.classList.toggle('active');
			menu.classList.toggle('active');
		}
	</script>


	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
	<!--<script>
		function returnPage() {
			window.location.href = "file:///C:/xampp/htdocs/testareProiect2/Foundation-Sites-CSS/interfata%20user.html";
		}
	</script>-->



	<!----------------------------------------------------------sfarsit------------------------------------------>
	<script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
</body>

</html>