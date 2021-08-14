<?php include "DB_connect.php"; session_start();
if (isset($_POST['add'])) {
    if (isset($_POST['region']) && $_POST['region'] != '' && isset($_POST['number']) && $_POST['number'] != ''
     && isset($_POST['message']) && $_POST['message'] != '') {
        $region = $_POST['region'];
        $number = $_POST['number'];
        $message = $_POST['message'];

        $sql = "INSERT INTO messages (region, number, message)
        VALUES ('$region', '$number', '$message')";

        $result = $conn->query($sql);

        header("Location: messages.php");

    } else {
        echo 'fill in all of the field';
    }
} else if (isset($_POST['edit'])) {
    if (isset($_POST['armor_to_edit']) && $_POST['armor_to_edit'] != '' && isset($_POST['edit_posses']) && $_POST['edit_posses'] != '')  {
        $armor_to_edit = $_POST['armor_to_edit'];
        $edit_posses = $_POST['edit_posses'];

        $sql = "UPDATE jewels SET posses = '$edit_posses' WHERE name = '$armor_to_edit'";

        $result = $conn->query($sql);

        header("Location: jewels.php");
    }
} else {
    echo 'how... did i get here?';
}