<?php include "DB_connect.php"; session_start();
if (isset($_POST['add'])) {
    if (isset($_POST['picture_id']) && $_POST['picture_id'] != '' && isset($_POST['picture_type']) && $_POST['picture_type'] != ''
     && isset($_POST['picture_name']) && $_POST['picture_name'] != '' && isset($_POST['picture_posses']) && $_POST['picture_posses'] != '')  {
        $picture_id = $_POST['picture_id'];
        $picture_type = $_POST['picture_type'];
        $picture_name = $_POST['picture_name'];
        $picture_posses = $_POST['picture_posses'];

        $sql = "INSERT INTO pictures (picture_id, picture_type, picture_name, picture_posses)
        VALUES ('$picture_id', '$picture_type', '$picture_name', '$picture_posses')";

        $result = $conn->query($sql);


        header("Location: pictures.php");

    } else {
        echo 'fill in all of the field';
    }
} else if (isset($_POST['edit'])) {
    if (isset($_POST['picture_name']) && $_POST['picture_name'] != '')  {
        $picture_name = $_POST['picture_name'];

        if (isset($_POST['edit_picture'])) {
            $picture_posses = 1;
        } else {
            $picture_posses = 0;
        }

        $sql = "UPDATE pictures SET picture_posses = '$picture_posses' WHERE picture_name = '$picture_name'";

        $result = $conn->query($sql);

        header("Location: pictures.php");
    } else {
        echo 'fill in all of the field';
    }
} else {
    echo 'no submit pressed';
}