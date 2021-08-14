<?php include "DB_connect.php"; session_start();

if (isset($_POST['add'])) {
    if (isset($_POST['armor_id']) && $_POST['armor_id'] != '' && 
    isset($_POST['armor_name']) && $_POST['armor_name'] != '') 
    {
        $armor_id = $_POST['armor_id'];
        $armor_name = $_POST["armor_name"];
        $sum = 0;

        $sql = "SELECT max(armor_id + 0) FROM all_armors";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $max_id = implode($row);

        if ($armor_id <= $max_id ) {
            for ($id = $max_id; $id >= $armor_id; $id--) {
                $new_id = $id + 1;
                $sql_id = "UPDATE all_armors SET armor_id = $new_id WHERE armor_id = $id";
                $result_id = mysqli_query($conn, $sql_id);
            }
        }

        if (isset($_POST["head"])) {
            $head = '0';
            $sum++;
        } else {
            $head = '-';
        }

        if (isset($_POST["chest"])) {
            $chest = '0';
            $sum++;
        } else {
            $chest = '-';
        }

        if (isset($_POST["arms"])) {
            $arms = '0';
            $sum++;
        } else {
            $arms = '-';
        }

        if (isset($_POST["coil"])) {
            $coil = '0';
            $sum++;
        } else {
            $coil = '-';
        }

        if (isset($_POST["greaves"])) {
            $greaves = '0';
            $sum++;
        } else {
            $greaves = '-';
        }

        $sql = "INSERT INTO all_armors (armor_id, armor_name, head, chest, arms, coil, greaves, sum, sum_posses)
        VALUES ('$armor_id', '$armor_name', '$head', '$chest', '$arms', '$coil', '$greaves', '$sum', '0')";

        echo $sql;

        $result = $conn->query ($sql);

        header("Location: all_armor.php");

    } else {
        echo 'not all field filled';
    }
} else if (isset($_POST['edit'])) {
    $armor_name = $_POST['armor_to_edit'];
    $sum_posses = $_POST['sum_posses'];

    if (isset($_POST['head']) && $_POST['head'] != '') {
        $types[1] = 'head';
        $sql_armor['1'] = "head = 1";
        $sum_posses++;
    }

    if (isset($_POST['chest']) && $_POST['chest'] != '') {
        $types[2] = 'chest';
        $sql_armor['2'] = "chest = 1";
        $sum_posses++;
    }

    if (isset($_POST['arms']) && $_POST['arms'] != '') {
        $types[3] = 'arms';
        $sql_armor['3'] = "arms = 1";
        $sum_posses++;
    }

    if (isset($_POST['coil']) && $_POST['coil'] != '') {
        $types[4] = 'coil';
        $sql_armor['4'] = "coil = 1";
        $sum_posses++;
    }

    if (isset($_POST['greaves']) && $_POST['greaves'] != '') {
        $types[5] = 'greaves';
        $sql_armor['5'] = "greaves = 1";
        $sum_posses++;
    }

    if (isset($_POST['armor_id']) && $_POST['armor_id'] != '') {
        $armor_id = $_POST['armor_id'];
        $sql_armor['6'] = "armor_id = '$armor_id'";
    }

    $sql_armor['7'] = "sum_posses = '$sum_posses'";

    $sql = implode($sql_armor, ', ');

    $sql = "UPDATE all_armors SET " . $sql . " WHERE armor_name = '$armor_name'";

    // echo $sql;

    $result = $conn->query($sql);

    if (isset($types)) {
        foreach ($types as $type ) {
            $sql = "UPDATE armor_sets SET posses = 1, level = 1 WHERE (armor_set = '$armor_name') AND (type = '$type')";
            $result = $conn->query($sql);
        }
    }
    
    // header("Location: all_armor.php");

    header("location:javascript://history.go(-1)");

    
} else if (isset($_POST['delete'])) {
    $armor_name = $_POST['armor_to_edit'];

    if ($_POST["head_delete"] != '-') {
        $piece[1] = 'head = 0';
        $types[1] = 'head';
    }

    if ($_POST["chest_delete"] != '-') {
        $piece[2] = 'chest = 0';
        $types[2] = 'chest';
    }

    if ($_POST["arms_delete"] != '-') {
        $piece[3] = 'arms = 0';
        $types[3] = 'arms';
    }

    if ($_POST["coil_delete"] != '-') {
        $piece[4] = 'coil = 0';
        $types[4] = 'coil';
    }

    if ($_POST["greaves_delete"] != '-') {
        $piece[5] = 'greaves = 0';
        $types[5] = 'greaves';
    }

    $piece = implode (', ', $piece);

    $sql = "UPDATE all_armors SET $piece, sum_posses = 0 WHERE armor_name = '$armor_name'";

    $result = $conn->query($sql);

    if (isset($types)) {
        foreach ($types as $type ) {
            $sql = "UPDATE armor_sets SET posses = 0, level = 0 WHERE (armor_set = '$armor_name') AND (type = '$type')";
            $result = $conn->query($sql);
        }
    }

    echo $sql;

    // header("Location: all_armor.php");

    header("location:javascript://history.go(-1)");
    
} else if (isset($_POST['head_plus'])) {
    $armor_name = $_POST['armor_name'];
    $sql = "SELECT level FROM armor_sets WHERE armor_set = '$armor_name' AND type = 'head'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $level = $row['level'];
    if ($level < 11) {
        $level++;
    }

    $sql = "UPDATE armor_sets SET level = '$level' WHERE armor_set = '$armor_name' AND type = 'head'";
    $result = mysqli_query($conn, $sql);

    header("location:javascript://history.go(-1)");

} else if (isset($_POST['chest_plus'])) {
    $armor_name = $_POST['armor_name'];
    $sql = "SELECT level FROM armor_sets WHERE armor_set = '$armor_name' AND type = 'chest'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $level = $row['level'];
    if ($level < 11) {
        $level++;
    }
    $sql = "UPDATE armor_sets SET level = '$level' WHERE armor_set = '$armor_name' AND type = 'chest'";
    $result = mysqli_query($conn, $sql);
    
    header("location:javascript://history.go(-1)");

} else if (isset($_POST['arms_plus'])) {
    $armor_name = $_POST['armor_name'];
    $sql = "SELECT level FROM armor_sets WHERE armor_set = '$armor_name' AND type = 'arms'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $level = $row['level'];
    if ($level < 11) {
        $level++;
    }
    $sql = "UPDATE armor_sets SET level = '$level' WHERE armor_set = '$armor_name' AND type = 'arms'";
    $result = mysqli_query($conn, $sql);

    header("location:javascript://history.go(-1)");

} else if (isset($_POST['coil_plus'])) {
    $armor_name = $_POST['armor_name'];
    $sql = "SELECT level FROM armor_sets WHERE armor_set = '$armor_name' AND type = 'coil'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $level = $row['level'];
    if ($level < 11) {
        $level++;
    }
    $sql = "UPDATE armor_sets SET level = '$level' WHERE armor_set = '$armor_name' AND type = 'coil'";
    $result = mysqli_query($conn, $sql);

    header("location:javascript://history.go(-1)");

} else if (isset($_POST['greaves_plus'])) {    
    $armor_name = $_POST['armor_name'];
    $sql = "SELECT level FROM armor_sets WHERE armor_set = '$armor_name' AND type = 'greaves'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $level = $row['level'];
    if ($level < 11) {
        $level++;
    }
    $sql = "UPDATE armor_sets SET level = '$level' WHERE armor_set = '$armor_name' AND type = 'greaves'";
    $result = mysqli_query($conn, $sql);

    header("location:javascript://history.go(-1)");

} else if (isset($_POST['reset'])) {
    $armor_name = $_POST['armor_name'];
    $sql = "UPDATE armor_sets SET level = 0 WHERE armor_set = '$armor_name'";
    $result = mysqli_query($conn, $sql);

    header("location:javascript://history.go(-1)");

} else {
    echo 'how... did i get here?';
}
