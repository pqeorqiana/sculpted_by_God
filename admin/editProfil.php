<?php
session_start();
include("connection.php");


$admin_id = $_SESSION['id'];

// Preluăm datele actuale ale admin-ului din tabelul admini
$query = "SELECT * FROM admini WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
  $admin = $result->fetch_assoc();
} else {
  // Nu s-au găsit date pentru adminul curent
  $admin = null;
}

// Procesăm actualizarea profilului
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nume = $_POST['nume'];
  $email = $_POST['email'];
  $numartel = $_POST['numartel'];
  $parola = $_POST['parola'];

  // Actualizăm datele în tabelul admini
  if (!empty($parola)) {
    // Dacă s-a furnizat o parolă nouă, actualizăm și parola
    $update_query = "UPDATE admini SET nume = ?, email = ?, numartel = ?, parola = ? WHERE id = ?";
    $stmt = $con->prepare($update_query);
    $stmt->bind_param("ssssi", $nume, $email, $numartel, $parola, $admin_id);
  } else {
    // Dacă nu s-a furnizat parolă nouă, actualizăm doar celelalte câmpuri
    $update_query = "UPDATE admini SET nume = ?, email = ?, numartel = ? WHERE id = ?";
    $stmt = $con->prepare($update_query);
    $stmt->bind_param("sssi", $nume, $email, $numartel, $admin_id);
  }

  if ($stmt->execute()) {
    $success_message = "Profilul a fost actualizat cu succes!";
  } else {
    $error_message = "A apărut o eroare la actualizarea profilului.";
  }
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Editare Profil - Sculpted By God</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/styleAdDashboard.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

  <style>
    .profile-img-preview {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 20px;
    }

    .form-container {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    .form-container label {
      font-weight: 500;
      margin-bottom: 8px;
    }

    .form-container .form-group {
      margin-bottom: 20px;
    }

    .btn-primary {
      padding: 10px 30px;
      font-weight: 500;
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

            <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
              <div class="xp-profilebar text-right">
                <nav class="navbar p-0">
                  <ul class="nav navbar-nav flex-row ml-auto">
                    <li class="dropdown nav-item">
                      <a class="nav-link" href="#" data-toggle="dropdown">
                        <?php
                        if ($admin && isset($admin['poza']) && !empty($admin['poza'])) {
                          echo '<img src="data:image/jpeg;base64,' . base64_encode($admin['poza']) . '" 
                                                          style="width:40px; height:40px; border-radius:50%; object-fit:cover;" />';
                        } else {
                          echo '<img src="img/user.jpg" style="width:40px; border-radius:50%;" />';
                        }
                        ?>
                      </a>
                      <ul class="dropdown-menu small-menu">
                        <li>
                          <a href="editProfil.php">
                            <span class="material-icons">person_outline</span>
                            Profile
                          </a>
                        </li>
                        <li>
                          <a href="logout.php">
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
            <h4 class="page-title">Editare Profil</h4>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Sculpted by GOD</a></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="form-container">
                <?php if (isset($success_message)): ?>
                  <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <?php if (isset($error_message)): ?>
                  <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form method="POST">
                  <div class="form-group">
                    <label>Nume</label>
                    <input type="text" class="form-control" name="nume"
                      value="<?php echo htmlspecialchars($admin['nume'] ?? ''); ?>" required>
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email"
                      value="<?php echo htmlspecialchars($admin['email'] ?? ''); ?>" required>
                  </div>

                  <div class="form-group">
                    <label>Număr Telefon</label>
                    <input type="tel" class="form-control" name="numartel"
                      value="<?php echo htmlspecialchars($admin['numartel'] ?? ''); ?>" required>
                  </div>

                  <div class="form-group">
                    <label>Parolă Nouă (lăsați gol pentru a păstra parola actuală)</label>
                    <input type="password" class="form-control" name="parola">
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Actualizează Profil</button>
                  </div>
                </form>
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

  <script>
    // Preview imagine
    function previewImage(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          document.getElementById('profileImagePreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    // Toggle sidebar
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