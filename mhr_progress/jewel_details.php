<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/jewels.css" type="text/css">
        <title>Index</title>
    </head>
    <body>
        <header>
            <?php $edit_adress = 'jewel_details'; ?>
            <?php include "menu.php"?>
        </header>

        <?php
        $sql = "SELECT * FROM jewels";
        $result = mysqli_query($conn, $sql); 
        
        $sql_count = "SELECT SUM(posses), SUM(level) FROM jewels";
        $result_count = mysqli_query($conn, $sql_count);
        $row_count = mysqli_fetch_assoc($result_count); ?>

        <main>
            <table class="detalis_table_form"> <?php
                if ($_SESSION['edit'] == 1) {
                    $array_details = array ('name', 'siz', 'lvl', 'material 1', ' ', 'material 2', ' ', 'material 3', ' ', 'material 4', ' ', 'funds'); ?>
                    <tr> <?php
                        foreach ($array_details as $detail) { ?>
                            <td> <?php
                                echo $detail; ?>                                
                            </td> <?php
                        } ?>
                    </tr>
                    <tr class="tr_form">
                        <form action="jewels_2.php" method="post">
                            <td>
                                <input type="text" name="name" class="form_name">
                            </td>
                            <td>
                                <input type="text" name="size" class="form_num">
                            </td>
                            <td>
                                <input type="text" name="level" class="form_num">
                            </td>
                            <td>
                                <input type="text" name="mat_1" class="form_big">
                            </td>
                            <td>
                                <input type="text" name="mat_am_1" class="form_small">
                            </td>
                            <td>
                                <input type="text" name="mat_2" class="form_big">
                            </td>
                            <td>
                                <input type="text" name="mat_am_2" class="form_small">
                            </td>
                            <td>
                                <input type="text" name="mat_3" class="form_big">
                            </td>
                            <td>
                                <input type="text" name="mat_am_3" class="form_small">
                            </td>
                            <td>
                                <input type="text" name="mat_4" class="form_big">
                            </td>
                            <td>
                                <input type="text" name="mat_am_4" class="form_small">
                            </td>
                            <td>
                                <input type="text" name="funds" class="form_name">
                            </td>
                            <td class="div_add">
                                <input type="submit" name="add" class="form_add" value="+">
                            </td>
                        </form>
                    </tr> <?php
                } ?>
            </table>
            <ul class="detalis_ul">
                <li class="color<?php if ($row_count['SUM(level)'] == $row_count['SUM(posses)']) echo'_green' ?>">
                    <div class="div_name">
                        total
                    </div>
                    <div class="div_num">
                        :
                    </div>
                    <div class="div_num_big">
                        <?php echo $row_count['SUM(level)']; ?> 
                    </div>
                    <div class="div_num_big">
                        <?php echo $row_count['SUM(posses)']; ?>
                    </div>
                </li>
                <li>
                    <div class="div_name">
                        name
                    </div>
                    <div class="words">
                        size
                    </div>
                    <div class="words">
                        level 
                    </div>
                    <div class="words">
                        posses
                    </div>
                </li> <?php
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <li class="color<?php if ($row['posses'] == $row['level']) {echo '_green';}; ?>">
                        <div class="div_name">
                            <?php echo $row['name'] ?>
                        </div>
                        <div class="div_num">
                            <?php echo $row['size'] ?>
                        </div>
                        <div class="div_num">
                            <?php echo $row['level'] ?> 
                        </div>
                        <div class="div_num">
                            <?php echo $row['posses'] ?>
                        </div>
                        <div class="div_mat_name">
                            <?php echo $row['material_1'] ?>
                        </div>
                        <div class="div_num">
                            <?php echo $row['material_amount_1'] ?>
                        </div>
                        <div class="div_mat_name">
                            <?php echo $row['material_2'] ?> 
                        </div>
                        <div class="div_num">
                            <?php echo $row['material_amount_2'] ?>
                        </div>
                        <div class="div_mat_name">
                            <?php echo $row['material_3'] ?>
                        </div>
                        <div class="div_num">
                            <?php echo $row['material_amount_3'] ?>
                        </div>
                        <div class="div_mat_name">
                            <?php echo $row['material_4'] ?> 
                        </div>
                        <div class="div_num">
                            <?php echo $row['material_amount_4'] ?>
                        </div>
                        <div class="div_name">
                            <?php echo $row['funds'] ?>
                        </div>
                    </li> <?php
                } ?>
            </ul>
        </main>
    </body>
</html>
