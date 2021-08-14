<?php include "DB_connect.php"; session_start();

if ($_GET['edit'] == 0){
    $_SESSION['edit'] = 0;
} else if ($_GET['edit'] == 1){
    $_SESSION['edit'] = 1;
}

$edit_adress = $_GET['page'];

header("Location: $edit_adress.php");
