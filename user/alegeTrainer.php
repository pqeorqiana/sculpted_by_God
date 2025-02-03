<!DOCTYPE html>
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
  <link rel="stylesheet" href="../css/custom2.css">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
  <header>
    <div class="collapse bg-dark" id="navbarHeader">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-7 py-4">
            <h4 class="text-white">About</h4>
            <p class="text-muted">Add some information about the album below, the author, or any other background
              context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off
              to some social networking sites or contact information.</p>
          </div>
          <div class="col-sm-4 offset-md-1 py-4">
            <h4 class="text-white">Contact</h4>
            <ul class="list-unstyled">
              <li><a href="#" class="text-white">Follow on Twitter</a></li>
              <li><a href="#" class="text-white">Like on Facebook</a></li>
              <li><a href="#" class="text-white">Email me</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
      <div class="container d-flex justify-content-between">
        <button class="btn btn-lg transparent-button">
          <a href="http://localhost/testareProiect2/Foundation-Sites-CSS/user/interfataUserTr.php" class="text-white">
            <span class="material-icons back-icon">arrow_back</span>
            <span class="button-text">Inapoi</span>
          </a>
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader"
          aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>
  </header>

  <main role="main">

    <div class="container">
      <h1 class="jumbotron-heading">Lista Traineri</h1>
    </div>

    <style>
      span {
        color: black;
      }

      h2,
      h3 {
        color: white;
      }

      .card {
        background: #28282B;
      }
    </style>
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

        $query = "SELECT * FROM traineritest2";
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
                  <h2 class="card-title"><?php echo $row['nume']; ?></h2>
                  <h3>ID: <?php echo $id; ?></h3> <!-- Display the ID -->
                  <form method="POST" action="">
                    <input type="hidden" name="trainer_id" value="<?php echo $id; ?>">
                    <button class="btn btn-lg" onclick="window.location.href='https://example.com'">
                      <span class="material-icons me-2">search</span>
                    </button>

                    <button class="btn btn-lg" type="submit" name="submit">
                      <span class="material-icons me-2">add</span>
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

  </main>

  <script src="js/vendor/jquery.js"></script>
  <script src="js/vendor/what-input.js"></script>
  <script src="js/vendor/foundation.js"></script>
  <script src="js/app.js"></script>
  <script src="js/admin/jquery-3.3.1.slim.min.js"></script>
  <script src="js/admin/popper.min.js"></script>
  <script src="js/admin/bootstrap.min.js"></script>
  <script src="js/admin/jquery-3.3.1.min.js"></script>
</body>

</html>