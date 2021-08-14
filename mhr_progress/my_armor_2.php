<?php include "DB_connect.php"; session_start();

if ($_POST['submit']) {
    if (isset($_POST['piece_id']) && $_POST['piece_id'] != '' && 
    isset($_POST['armor_set']) && $_POST['armor_set'] != '' && 
    isset($_POST['rarity']) && $_POST['rarity'] != '' && 
    isset($_POST['type']) && $_POST['type'] != '' && 
    isset($_POST['defense']) && $_POST['defense'] != '' && 
    isset($_POST['fire_res']) && $_POST['fire_res'] != '' && 
    isset($_POST['water_res']) && $_POST['water_res'] != '' && 
    isset($_POST['thunder_res']) && $_POST['thunder_res'] != '' && 
    isset($_POST['ice_res']) && $_POST['ice_res'] != '' && 
    isset($_POST['dragon_res']) && $_POST['dragon_res'] != '' && 
    isset($_POST['mat_1']) && $_POST['mat_1'] != '' && 
    isset($_POST['mat_amount_1']) && $_POST['mat_amount_1'] != '' && 
    isset($_POST['funds']) && $_POST['funds'] != '') 
    {
        $piece_id = $_POST['piece_id'];
        $armor_set = $_POST["armor_set"];
        $rarity = $_POST["rarity"];
        $type = $_POST["type"];
        $defense = $_POST["defense"];
        $fire_res = $_POST["fire_res"];
        $water_res = $_POST["water_res"];
        $thunder_res = $_POST["thunder_res"];
        $ice_res = $_POST["ice_res"];
        $dragon_res = $_POST["dragon_res"];
        $slot_1 = $_POST["slot_1"];
        $slot_2 = $_POST["slot_2"];
        $slot_3 = $_POST["slot_3"];
        $skill_1 = $_POST["skill_1"];
        $skill_level_1 = $_POST["skill_level_1"];
        $skill_2 = $_POST["skill_2"];
        $skill_level_2 = $_POST["skill_level_2"];
        $skill_3 = $_POST["skill_3"];
        $skill_level_3 = $_POST["skill_level_3"];
        $skill_4 = $_POST["skill_4"];
        $skill_level_4 = $_POST["skill_level_4"];
        $mat_1 = $_POST["mat_1"];
        $mat_amount_1 = $_POST["mat_amount_1"];
        $mat_2 = $_POST["mat_2"];
        $mat_amount_2 = $_POST["mat_amount_2"];
        $mat_3 = $_POST["mat_3"];
        $mat_amount_3 = $_POST["mat_amount_3"];
        $mat_4 = $_POST["mat_4"];
        $mat_amount_4 = $_POST["mat_amount_4"];
        $funds = $_POST["funds"];


        $sql = "SELECT max(piece_id + 0) FROM armor_sets";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $max_id = implode($row);

        if ($piece_id <= $max_id ) {
            for ($id = $max_id; $id >= $piece_id; $id--) {
                $new_id = $id + 1;
                $sql_id = "UPDATE armor_sets SET piece_id = $new_id WHERE piece_id = $id";
                $result_id = mysqli_query($conn, $sql_id);
            }
        }

        
        $sql = "INSERT INTO armor_sets (piece_id, armor_set, rarity, type, level,
        defense, fire_resistance, water_resistance, thunder_resistance, ice_resistance, dragon_resistance,
        slot_1, slot_2, slot_3, skill_1, skill_level_1, skill_2, skill_level_2, skill_3, skill_level_3, skill_4, skill_level_4,
        material_1, material_amount_1, material_2, material_amount_2, material_3, material_amount_3, material_4, material_amount_4, funds)
        VALUES ('$piece_id', '$armor_set', '$rarity', '$type', '1',
        '$defense', '$fire_res', '$water_res', '$thunder_res', '$ice_res', '$dragon_res',
        '$slot_1', '$slot_2', '$slot_3', '$skill_1', '$skill_level_1', '$skill_2', '$skill_level_2', '$skill_3', '$skill_level_3', '$skill_4', '$skill_level_4',
        '$mat_1', '$mat_amount_1', '$mat_2', '$mat_amount_2', '$mat_3', '$mat_amount_3', '$mat_4', '$mat_amount_4', '$funds')";

        $result = mysqli_query($conn, $sql);

        var_dump ($_POST);

        echo '<br><br>';

        echo $sql;

        header("Location: my_armor.php");

    } else {
        echo 'not all field filled';
    }
} else {
    echo 'how... did i get here?';
}
