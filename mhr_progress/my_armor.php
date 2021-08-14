<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/my_armor.css" type="text/css">
        <title>Index</title>
    </head>
    <body>
        <header>
            <?php $edit_adress = 'my_armor'; ?>
            <?php include "menu.php"?>
        </header>
        <main>
        <form name="new_armor" class="new_armor" action="my_armor_2.php" method="post">
                <table class="table_form">
                    <tr>
                        <td>
                            <p>piece id</p>
                            <input class="small_2" type="text" name="piece_id">
                        </td>
                        <td>
                            <p>armor set</p>
                            <input class="form_name" type="text" name="armor_set">
                        </td>
                        <td>
                            <p>rarity</p>
                            <input class="small" type="text" name="rarity">
                        </td>
                        <td>
                            <p>type</p>
                            <input class="form_type" type="text" name="type">
                        </td>
                        <td>
                            <p>defense</p>
                            <input class="small" type="text" name="defense">
                        </td>
                        <td>
                            <p>fire res</p>
                            <input class="small" type="text" name="fire_res">
                        </td>
                        <td>
                            <p>water res</p>
                            <input class="small" type="text" name="water_res">
                        </td>
                        <td>
                            <p>thun res</p>
                            <input class="small" type="text" name="thunder_res">
                        </td>
                        <td>
                            <p>ice res</p>
                            <input class="small" type="text" name="ice_res">
                        </td>
                        <td>
                            <p>drag res</p>
                            <input class="small" type="text" name="dragon_res">
                        </td>
                        <td>
                            <p>slots</p>
                            <input class="small" type="text" name="slot_1">
                            <input class="small" type="text" name="slot_2">
                            <input class="small" type="text" name="slot_3">
                        </td>
                        <td>
                            <p>skill 1</p>
                            <input class="mid" type="text" name="skill_1">
                            <input class="small" type="text" name="skill_level_1">
                        </td>
                        <td>
                            <p>skill 2</p>
                            <input class="mid" type="text" name="skill_2">
                            <input class="small" type="text" name="skill_level_2">
                        </td>
                        <td>
                            <p>skill 3</p>
                            <input class="mid" type="text" name="skill_3">
                            <input class="small" type="text" name="skill_level_3">
                        </td>
                        <td>
                            <p>skill 4</p>
                            <input class="mid" type="text" name="skill_4">
                            <input class="small" type="text" name="skill_level_4">
                        </td>
                        <td>
                            <p>material 1</p>
                            <input class="form_mat" type="text" name="mat_1">
                            <input class="small" type="text" name="mat_amount_1">
                        </td>
                        <td>
                            <p>material 2</p>
                            <input class="form_mat" type="text" name="mat_2">
                            <input class="small" type="text" name="mat_amount_2">
                        </td>
                        <td>
                            <p>material 3</p>
                            <input class="form_mat" type="text" name="mat_3">
                            <input class="small" type="text" name="mat_amount_3">
                        </td>
                        <td>
                            <p>material 4</p>
                            <input class="form_mat" type="text" name="mat_4">
                            <input class="small" type="text" name="mat_amount_4">
                        </td>
                        <td>
                            <p>funds</p>
                            <input class="form_type" type="text" name="funds">
                        </td>
                        <td class="big_plus_field">
                            <input class="big_plus" type="submit" name="submit" value="+">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            $sql = "SELECT * FROM armor_sets ORDER BY length(piece_id) ASC, piece_id ASC";

            $result = mysqli_query($conn, $sql);
            $query_results = mysqli_num_rows($result);

            $content_names = array ('', 'id', 'name', 'rarity', 'type', 'level', 'def', 'fire res', 'water res', 'thun res', 'ice res', 'drag res', 's 1', 's 2', 's 3', 'skill 1', 'skill 2', 'skill 3', 'skill 4', 'material 1', 'material 2', 'material 3', 'material 4', 'funds');

            ?>
            <table class="table_content"> 
                <tr> <?php
                    foreach ($content_names as $content_name) { ?>
                        <td> <?php
                            echo $content_name; ?>
                        </td> <?php
                    } ?>
                </tr> <?php

                $u = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $u++;
                    $array_3[$u] = $row;

                    $array_3[$u]['skill_1'] = $array_3[$u]['skill_1'] . ' ' . $array_3[$u]['skill_level_1'];
                    $array_3[$u]['skill_2'] = $array_3[$u]['skill_2'] . ' ' . $array_3[$u]['skill_level_2'];
                    $array_3[$u]['skill_3'] = $array_3[$u]['skill_3'] . ' ' . $array_3[$u]['skill_level_3'];
                    $array_3[$u]['skill_4'] = $array_3[$u]['skill_4'] . ' ' . $array_3[$u]['skill_level_4'];

                    $array_3[$u]['material_1'] = $array_3[$u]['material_1'] . ' x' . $array_3[$u]['material_amount_1'];
                    $array_3[$u]['material_2'] = $array_3[$u]['material_2'] . ' x' . $array_3[$u]['material_amount_2'];
                    $array_3[$u]['material_3'] = $array_3[$u]['material_3'] . ' x' . $array_3[$u]['material_amount_3'];
                    $array_3[$u]['material_4'] = $array_3[$u]['material_4'] . ' x' . $array_3[$u]['material_amount_4'];

                    unset ($array_3[$u]['skill_level_1']);
                    unset ($array_3[$u]['skill_level_2']);
                    unset ($array_3[$u]['skill_level_3']);
                    unset ($array_3[$u]['skill_level_4']);
                    unset ($array_3[$u]['material_amount_1']);
                    unset ($array_3[$u]['material_amount_2']);
                    unset ($array_3[$u]['material_amount_3']);
                    unset ($array_3[$u]['material_amount_4']);
                }

                foreach ($array_3 as $arra_2) { ?>
                    <tr> <?php
                        foreach ($arra_2 as $element) { ?>
                            <td> <?php
                                if ($element != '') {
                                    echo $element;
                                } ?>
                            </td> <?php
                        } ?>
                    </tr> <?php
                } ?>
            </table>
        </main>
    </body>
</html>
