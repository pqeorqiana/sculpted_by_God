<?php
// Start the session
session_start();
include('urls.php');

// Check if the user is logged in
if (!isset($_SESSION['nume']) || !isset($_SESSION['user_type'])) {
    header("location:interfata login.php");
    exit();
}

// Get the session ID
$id = $_SESSION['id'];

// Insert the session ID and retrieve the trainer ID
require 'connection.php';

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
    <link rel="stylesheet" href="../css/styleUserTr.css">


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
                            <li class="breadcrumb-item active" aria-curent="page">User</li>
                        </ol>
                    </div>


                </div>
            </div>
            <style>
                span {
                    color: black;
                }

                body {
                    background: white;
                }

                .card {
                    background: #28282B;
                }
            </style>
            <!----------------------------------------------sectiunea Trainer------------------------------------------->
            <section id="trainers" class="trainers view">
                <div class="main">
                    <button class="btn btn-secondary my-5"><a
                            href="http://localhost/testareProiect2/Foundation-Sites-CSS/user/alegeTrainer.php">Alege un
                            trainer</a></button>

                </div>

                <div class="container py-5">
                    <div class="row mt-4">
                        <?php
                        require 'connection.php';

                        // Check if the form is submitted
                        if (isset($_POST['submit'])) {
                            // Get the session ID
                            session_start();
                            $useritest_id = $_SESSION['id'];

                            // Get the trainer ID from the clicked button
                            $traineritest2_id = $_POST['trainer_id'];

                            // Insert the data into the useritest2 table
                            $insert_query = "INSERT INTO useritest2 (useritest_id, traineritest2_id) VALUES ('$useritest_id', '$traineritest2_id')";
                            $insert_result = mysqli_query($con, $insert_query);

                            if ($insert_result) {
                                header("Location: " . $_SERVER['HTTP_REFERER']);
                                exit();
                            } else {
                                echo "Error: " . mysqli_error($con);
                            }
                        }


                        $useritest_id = $_SESSION['id'];

                        $query = "SELECT DISTINCT t.id, t.nume, t.poza
                      FROM traineritest2 t
                      INNER JOIN useritest2 u ON t.id = u.traineritest2_id
                      WHERE u.useritest_id = '$useritest_id'";
                        $query_run = mysqli_query($con, $query);
                        $check = mysqli_num_rows($query_run) > 0;
                        if ($check) {
                            while ($row = mysqli_fetch_array($query_run)) {
                                $id = $row['id']; // Get the ID from the row
                                $photoData = $row['poza'];
                                $imageSrc = 'data:image/jpeg;base64,' . base64_encode($photoData);
                                ?>
                        <div class="col-md-3 mt-3">
                            <div class="card">
                                <img src="<?php echo $imageSrc; ?>" width="253px" height="200px" alt="">
                                <div class="card-body">
                                    <h2 class="card-title">
                                        <?php echo $row['nume']; ?>
                                    </h2>
                                    <h3>ID:
                                        <?php echo $id; ?>
                                    </h3> <!-- Display the ID -->
                                            <form method="POST" action="">
                                                <input type="hidden" name="trainer_id" value="<?php echo $id; ?>">
                                                <button class="btn btn-lg" onclick="window.location.href='https://example.com'">
                                                    <span class="material-icons me-2">search</span>
                                                </button>

                                                <button class="btn btn-lg" type="submit" name="submit">
                                                    <span class="material-icons me-2">remove</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No data";
                        }
                        mysqli_close($con);
                        ?>
                    </div>
                </div>
            </section>

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