<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/checklist.css" type="text/css">
        <title>Index</title>
    </head>
    <body>
        <header>
            <?php $edit_adress = 'all_armor'; ?>
            <?php include "menu.php"?>
        </header>
        <main>
    
            <?php
            $sql_2 = "SELECT DISTINCT material_1 as mat FROM armor_sets UNION SELECT DISTINCT material_2 FROM armor_sets UNION SELECT DISTINCT material_3 FROM armor_sets UNION SELECT DISTINCT material_4 FROM armor_sets";
            $result_2 = mysqli_query($conn, $sql_2);

            $sql_funds = "SELECT sum(funds) FROM armor_sets WHERE posses = 0";
            $result_funds = mysqli_query($conn, $sql_funds);
            $row_funds = mysqli_fetch_assoc($result_funds);
            ?>

            <ul> <?php
            

                while ($row = mysqli_fetch_assoc($result_2)) { ?>
                    <li> <?php
                        $mat = $row['mat'];
                        for ($i = 1; $i <= 4; $i++) {
                            $sql_query[$i] = "SELECT sum(material_amount_$i) FROM armor_sets WHERE (material_$i = '$mat') AND posses = 0";
                            $result[$i] = mysqli_query($conn, $sql_query[$i]);
                            $row[$i] = mysqli_fetch_assoc($result[$i]);
                            $all_mats[$i] = implode($row[$i], '');
                        }
                        unset($i);

                        $sum = array_sum($all_mats);

                        if ($sum != 0 ) { ?>
                            <div class="mat"> <?php
                            echo $mat . ' '; ?>
                            </div>
                            <div class="sum"> <?php
                                echo $sum; ?>
                            </div>  <?php
                        } ?>
                    </li> <?php
                } ?>
                <li>
                    <div class="mat">
                        <?php echo 'funds: ' . $row_funds['sum(funds)'] . ' z'; ?>
                    </div>
                </li>
            </ul>
        </main>
    </body>
</html>
