<?php include "DB_connect.php"; session_start();
if (isset($_POST['add'])) {
    if (isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['size']) && $_POST['size'] != ''
     && isset($_POST['level']) && $_POST['level'] != '')  {
        $name = $_POST['name'];
        $size = $_POST['size'];
        $level = $_POST['level'];
        $mat_1 = $_POST["mat_1"];
        $mat_amount_1 = $_POST["mat_amount_1"];
        $mat_2 = $_POST["mat_2"];
        $mat_amount_2 = $_POST["mat_amount_2"];
        $mat_3 = $_POST["mat_3"];
        $mat_amount_3 = $_POST["mat_amount_3"];
        $mat_4 = $_POST["mat_4"];
        $mat_amount_4 = $_POST["mat_amount_4"];
        $funds = $_POST["funds"];

        $sql = "INSERT INTO jewels (name, size, level, posses, material_1, material_amount_1, material_2, material_amount_2, material_3, material_amount_3, material_4, material_amount_4, funds)
        VALUES ('$name', '$size', '$level', '0', '$mat_1', '$mat_amount_1', '$mat_2', '$mat_amount_2', '$mat_3', '$mat_amount_3', '$mat_4', '$mat_amount_4', '$funds')";

        $result = $conn->query($sql);

        header("Location: jewel_details.php");

    } else {
        echo 'fill in all of the field';
    }
} else if (isset($_POST['jewel_to_edit'])) {
    if (isset($_POST['jewel_to_edit']) && $_POST['jewel_to_edit'] != '' && isset($_POST['posses_to_edit']) && $_POST['posses_to_edit'] != '' ) {
        $jewel_to_edit = $_POST['jewel_to_edit'];
        $posses = $_POST['posses_to_edit'];

        if (isset($_POST['plus'])) {
            $posses++;
        }

        if (isset($_POST['minus'])) {
            $posses--;
        }

        $sql = "UPDATE jewels SET posses = '$posses' WHERE name = '$jewel_to_edit'";

        $result = $conn->query($sql);

        header("Location: jewels.php");
    }
} else {
    echo 'how... did i get here?';
}