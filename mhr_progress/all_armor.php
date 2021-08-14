<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/all_armor.css" type="text/css">
        <title>Index</title>
    </head>
    <body>
        <header>
            <?php $edit_adress = 'all_armor'; ?>
            <?php include "menu.php"?>
        </header>
        <main>
            <?php

            $sql = "SELECT * FROM all_armors ORDER BY armor_id ASC";

            $result = mysqli_query($conn, $sql);
            $query_results = mysqli_num_rows($result);

            $sql_count_armor = "SELECT COUNT(*) FROM all_armors WHERE sum = sum_posses";
            $result_armor = $conn->query($sql_count_armor);
            $count_armor = mysqli_fetch_assoc($result_armor);

            $all_count_armor = "SELECT COUNT(*) FROM all_armors";
            $all_armor = $conn->query($all_count_armor);
            $all_armor = mysqli_fetch_assoc($all_armor);

            ?>
            <table> <?php
                if ($query_results > 0) { ?>
                    <tr class="check_color<?php if ($all_armor['COUNT(*)'] == $count_armor['COUNT(*)']) { echo'_green'; } else { echo '_red'; } ?>">
                        <td>
                            <p> total: <?php echo $count_armor['COUNT(*)']; ?> / <?php echo $all_armor['COUNT(*)']; ?> </p>
                        </td> <?php
                        for ($i=1; $i <=5; $i++) { ?>
                            <td class="square_box">
                            </td> <?php 
                        }
                        if ($_SESSION['edit'] == 1) { ?>
                            <td class="last_square_box">
                                armor &
                                level
                            </td> <?php 
                        } ?>
                    </tr> <?php
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr> <?php 
                            $sum = $row['sum'];
                            $sum_posses = $row['sum_posses'];
                            $head = $row['head'];
                            $chest = $row['chest'];
                            $arms = $row['arms'];
                            $coil = $row['coil'];
                            $greaves = $row['greaves'];
                            $armor_name = $row['armor_name'];
                            $sql_level = "SELECT 	(SELECT level FROM armor_sets WHERE armor_set = '$armor_name' AND type = 'head') as head, 
                                                    (SELECT level FROM armor_sets WHERE armor_set = '$armor_name' AND type = 'chest') as chest, 
                                                    (SELECT level FROM armor_sets WHERE armor_set = '$armor_name' AND type = 'arms') as arms, 
                                                    (SELECT level FROM armor_sets WHERE armor_set = '$armor_name' AND type = 'coil')as coil, 
                                                    (SELECT level FROM armor_sets WHERE armor_set = '$armor_name' AND type = 'greaves') as greaves";
                            $result_level = mysqli_query($conn, $sql_level);
                            $query_result_level = mysqli_num_rows($result_level);
                            $row_level = mysqli_fetch_assoc($result_level); 
                            $head_level = $row_level['head'];
                            $chest_level = $row_level['chest'];
                            $arms_level = $row_level['arms'];
                            $coil_level = $row_level['coil'];
                            $greaves_level = $row_level['greaves'];

                            $sum_level = array($head_level, $chest_level, $arms_level, $coil_level, $greaves_level);
                            $sum_level = array_sum($sum_level); ?>

                            <td class="check_color<?php color_all($sum_level, $sum, $sum_posses) ?>">
                                <?php echo $armor_name; ?>
                            </td> <?php

                            $arr = array ('head', 'chest', 'arms', 'coil', 'greaves');
                            $array = array ($head, $chest, $arms, $coil, $greaves);
                            $array_level = array ($head_level, $chest_level, $arms_level, $coil_level, $greaves_level);

                            for ($i = 0; $i <= 4; $i++) { ?>
                                <td class="check_color<?php color($array_level[$i]); ?>">
                                    <?php if ($array[$i] != '-') { echo $arr[$i] ?> <br> <?php } ?>
                                </td> <?php
                            } ?>

                            <?php if ($_SESSION['edit'] == 1) { ?>
                                <td>
                                    <?php echo $row['armor_id'] ?>
                                </td>
                                <form action="all_armor_2.php" method="post">
                                    <td class="piece_1">
                                        h
                                    </td>
                                    <td class="piece_2">
                                        c
                                    </td>
                                    <td class="piece_3">
                                        a
                                    </td>
                                    <td class="piece_4">
                                        c
                                    </td>
                                    <td class="piece_5">
                                        g
                                    </td>
                                    <td class="edit">
                                        <input class="big_plus" type="submit" name="edit" value="EDIT">
                                        <input type="hidden" name="armor_to_edit" value="<?php echo $armor_name; ?>">
                                        <input type="hidden" name="sum_posses" value="<?php echo $row['sum_posses']; ?>">
                                    </td>
                                    <td class="delete">
                                        <input class="big_plus" type="submit" name="delete" value="DEL">
                                        <input type="hidden" name="head_delete" value="<?php echo $row['head']; ?>">
                                        <input type="hidden" name="chest_delete" value="<?php echo $row['chest']; ?>">
                                        <input type="hidden" name="arms_delete" value="<?php echo $row['arms']; ?>">
                                        <input type="hidden" name="coil_delete" value="<?php echo $row['coil']; ?>">
                                        <input type="hidden" name="greaves_delete" value="<?php echo $row['greaves']; ?>">
                                    </td>
                                </tr>
                                <tr class="check_boxes">
                                    <td class="check_color<?php color_all($sum_level, $sum, $sum_posses) ?>">
                                    </td> <?php

                                    for ($i = 0; $i <= 4; $i++) { ?>
                                        <td class="check_color<?php color($array_level[$i]); ?>"> <?php
                                            if ($array[$i] != '-') { ?> <input class="small" type="checkbox" name="<?php echo $arr[$i] ?>"> <?php }
                                            if ($array[$i] == '1') { ?> <div class="small_div"> <?php echo $array_level[$i]; ?></div> <?php } ?>
                                        </td> <?php
                                    } ?>

                                    <form action="all_armor_2.php" method="post">
                                        <td class="small_text">
                                            <input class="reset" type="submit" name="reset" value="re:">
                                        </td>
                                        <input type="hidden" name="armor_name" value="<?php echo $armor_name; ?>"> <?php

                                        for ($i = 0; $i <= 4; $i++) { ?>
                                            <td> <?php
                                                if ($array[$i] == 1 && $array_level[$i] < 11) { ?>
                                                    <input class="level" type="submit" name="<?php echo $arr[$i]; ?>_plus" value="+"> <?php
                                                } ?>
                                            </td> <?php
                                        } ?>
                                    </form>
                                </tr>
                            </form> <?php
                        } ?>
                        </tr> <?php
                    }
                } ?>
            </table>
            <form name="new_armor" class="new_armor" action="all_armor_2.php" method="post">
                <table>
                    <tr>
                        <td class="piece_and_armor">
                            <p>armor id:</p>
                            <input class="small" type="text" name="armor_id">
                            <p>armor name:</p>
                            <input type="text" name="armor_name">
                        </td>
                        <td class="gear_pieces">
                            <p>head <input class="gear" type="checkbox" name="head"></p>
                            <p>chest <input class="gear" type="checkbox" name="chest"></p>
                            <p>arms <input class="gear" type="checkbox" name="arms"></p>
                            <p>coil <input class="gear" type="checkbox" name="coil"></p>
                            <p>greaves <input class="gear" type="checkbox" name="greaves"></p>
                        </td>
                        <td class="big_plus_field">
                            <input type="submit" name="add" value="+">
                        </td>
                    </tr>
                </table>
            </form>
        </main>
    </body>
</html>

<?php


function color($color) {
    switch ($color) {
        case '':
            echo '_grey';
            break;
        case '0':
            echo '_red';
            break;       
        case '11':
            echo '_blue';
            break;
        default:
            echo '_green';
    }
}

function color_all($sum_level, $sum, $sum_posses) {
    if ($sum_level == 55) {
        echo '_blue';
    } else if ($sum == $sum_posses) {
        echo '_green';
    } else {
        echo '_red';
    }
}