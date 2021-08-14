<?php include "DB_connect.php"; session_start();
if (isset($_POST['add'])) {
    if (isset($_POST['monster_id']) && $_POST['monster_id'] != '' && isset($_POST['monster_name']) && $_POST['monster_name'] != ''
     && isset($_POST['big_crown']) && $_POST['big_crown'] != '' && isset($_POST['small_crown']) && $_POST['small_crown'] != '')  {
        $monster_id = $_POST['monster_id'];
        $monster_name = $_POST['monster_name'];
        $big_crown = $_POST['big_crown'];
        $small_crown = $_POST['small_crown'];

        $sql = "INSERT INTO monsters (monster_id, monster_name, big_crown, small_crown)
        VALUES ('$monster_id', '$monster_name', '$big_crown', '$small_crown')";

        $result = $conn->query($sql);

        header("Location: crowns.php");

    } else {
        echo 'fill in all of the field';
    }
} else if (isset($_POST['edit'])) {
    if (isset($_POST['edit_big_crown']) || isset($_POST['edit_small_crown']))  {
        $monster_to_edit = $_POST['monster_to_edit'];

        if (isset($_POST['edit_big_crown'])) {
            $sql_big = "big_crown = 1";
        } else {
            $sql_big = '';
        }

        if (isset($_POST['edit_small_crown'])) {
            $sql_small = "small_crown = 1";
        } else {
            $sql_small = '';
        }

        if (isset($_POST['edit_big_crown']) && isset($_POST['edit_small_crown'])) {
            $sql_comma = ", ";
        } else {
            $sql_comma = '';
        }

        $sql = "UPDATE monsters SET " . $sql_big . $sql_comma . $sql_small . " WHERE monster_name = '$monster_to_edit'";

        echo $sql;

        $result = $conn->query($sql);

        header("Location: crowns.php");
    } else{
        echo 'fill in all of the field';
    }
} elseif (isset($_POST['delete'])) {
    if (isset($_POST['monster_to_edit']) && $_POST['monster_to_edit'] != '') {
        $monster_to_edit = $_POST['monster_to_edit'];

        $sql = "UPDATE monsters SET big_crown = 0, small_crown = 0 WHERE monster_name = '$monster_to_edit'";

        echo $sql;

        $result = $conn->query($sql);

        header("Location: crowns.php");
    } else {
        echo 'fill in all of the field';
    }
} else {
    echo 'how... did i get here?';
}