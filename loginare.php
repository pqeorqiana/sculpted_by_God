<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    $nume = mysqli_real_escape_string($conn, $_POST['nume']);
    $parola = $_POST['parola'];
    $user_type = $_POST['user_type'];

    if ($user_type === "user") {
        if (!empty($nume) && !empty($parola)) {
            $query = "SELECT * FROM useritest WHERE nume='$nume' AND parola='$parola'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                // Login successful, redirect to user interface
                session_start();
                $_SESSION['nume'] = $nume;
                $_SESSION['user_type'] = $user_type;
                $row = mysqli_fetch_assoc($result);
                $id = $row['id']; // Assuming 'id' is the column name for the ID field in the 'useritest' table

                // Store the ID in a variable for later use
                $_SESSION['id'] = $id;

                header("location:user/interfataUser.php");
                exit();
            } else {
                echo 'Nume sau parola incorecta.';
            }
        } else {
            echo 'Completeaza nume si parola.';
        }
    } elseif ($user_type === "trainer") {
        if (!empty($nume) && !empty($parola)) {
            $query = "SELECT * FROM traineritest WHERE nume='$nume' AND parola='$parola'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                // Login successful, redirect to trainer interface
                session_start();
                $_SESSION['nume'] = $nume;
                $_SESSION['user_type'] = $user_type;
                $row = mysqli_fetch_assoc($result);
                $id = $row['id']; // Assuming 'id' is the column name for the ID field in the 'traineritest' table

                // Store the ID in a variable for later use
                $_SESSION['id'] = $id;

                header("location:trainer/interfata trainer.php");
                exit();
            } else {
                echo 'Nume sau parola incorecta.';
            }
        } else {
            echo 'Completeaza nume si parola.';
        }
    } elseif ($user_type === "admin") {
        if (!empty($nume) && !empty($parola)) {
            $query = "SELECT * FROM admini WHERE nume='$nume' AND parola='$parola'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                // Login successful, redirect to admin interface
                session_start();
                $_SESSION['nume'] = $nume;
                $_SESSION['user_type'] = $user_type;

                $row = mysqli_fetch_assoc($result);
                $id = $row['id']; // Assuming 'id' is the column name for the ID field in the respective table

                // Store the ID in a variable for later use
                $_SESSION['id'] = $id;
                header("location:admin/interfata adminDashboard.php");
                exit();
            } else {
                echo 'Nume sau parola incorecta.';
            }
        } else {
            echo 'Completeaza nume si parola.';
        }
    } else {
        echo 'user_type este null.';
    }
}
?>