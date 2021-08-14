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
            $sql_2 = "SELECT DISTINCT material_1 as mat FROM jewels UNION SELECT DISTINCT material_2 FROM jewels UNION SELECT DISTINCT material_3 FROM jewels UNION SELECT DISTINCT material_4 FROM jewels";
            $result_2 = mysqli_query($conn, $sql_2);

            $sql_funds = "SELECT sum(level - posses) * funds as funds FROM jewels";
            $result_funds = mysqli_query($conn, $sql_funds);
            $row_funds = mysqli_fetch_assoc($result_funds);

            ?>

            <ul> <?php

                while ($row = mysqli_fetch_assoc($result_2)) { ?>
                    <li> <?php
                        $mat = $row['mat'];
                        for ($i = 1; $i <= 4; $i++) {
                            $jewel_query[$i] = "SELECT sum((level - posses) * material_amount_$i) as mat_sum FROM jewels WHERE material_$i = '$mat'";
                            $jewel_result[$i] = mysqli_query($conn, $jewel_query[$i]);
                            
                            while ($jewel_row[$i] = mysqli_fetch_assoc($jewel_result[$i])) {
                                $jewel_sum[$i] = $jewel_row[$i]['mat_sum'];
                            }
                        }
                        $jewel_sum_total = array_sum($jewel_sum);
                        unset($i);

                        if ($jewel_sum_total != 0 ) { ?>
                            <div class="mat"> <?php
                                echo $mat . ' '; ?>
                            </div>
                            <div class="sum"> <?php
                                echo $jewel_sum_total; ?>
                            </div>  <?php
                        } ?>
                    </li> <?php
                } ?>
                <li>
                    <div class="mat">
                        <?php echo 'funds: ' . $row_funds['funds'] . ' z'; ?>
                    </div>
                </li>
            </ul>
        </main>
    </body>
</html>
