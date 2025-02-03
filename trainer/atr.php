<?php
include 'connection.php';
session_start();

if (isset($_GET['useritest_id']) && isset($_GET['exercitii_id'])) {
    $useritest_id = $_GET['useritest_id'];
    $exercitii_id = $_GET['exercitii_id'];

   $sql = "INSERT INTO atribuire (useritest_id, exercitii_id) VALUES (" . $session_id . ", " . $id . ")";

    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Valori inserate cu succes în tabela atribuire.";
    } else {
        echo "Eroare la inserarea valorilor în tabela atribuire: " . mysqli_error($con);
    }
}
?>
