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
            $sql_2 = "  SELECT DISTINCT material_1 as mat FROM armor_sets UNION SELECT DISTINCT material_2 FROM armor_sets UNION SELECT DISTINCT material_3 FROM armor_sets UNION SELECT DISTINCT material_4 FROM armor_sets
                        UNION SELECT DISTINCT material_1 FROM jewels UNION SELECT DISTINCT material_2 FROM jewels UNION SELECT DISTINCT material_3 FROM jewels UNION SELECT DISTINCT material_4 FROM jewels";
            $result_2 = mysqli_query($conn, $sql_2);

            $funds = "SELECT (SELECT sum(funds) FROM armor_sets WHERE posses = 0) as mat, (SELECT sum(level - posses) * funds FROM jewels) as jew";
            $result_funds = mysqli_query($conn, $funds);
            $row_funds = mysqli_fetch_assoc($result_funds);

            $row_funds = $row_funds['mat'] + $row_funds['jew'];
            ?>

            <ul> <?php
            
                while ($row = mysqli_fetch_assoc($result_2)) { ?>
                    <li> <?php
                        $mat = $row['mat'];
                        for ($i = 1; $i <= 4; $i++) {
                            $armor_query[$i] = "SELECT (SELECT COALESCE(sum(material_amount_$i), 0) FROM armor_sets WHERE material_$i = '$mat' AND posses = 0) +
                                                (SELECT COALESCE(sum((level - posses) * material_amount_$i), 0) FROM jewels WHERE material_$i = '$mat') as sum";
                            $result_armor[$i] = mysqli_query($conn, $armor_query[$i]);
                            $row_armor[$i] = mysqli_fetch_assoc($result_armor[$i]);
                            $all_armor_mats[$i] = implode($row_armor[$i], '');
                        }
                        unset($i);

                        $sum_armor = array_sum($all_armor_mats);
                        $sum_all = $sum_armor;

                        if ($sum_all != 0 ) { ?>
                            <div class="mat"> <?php
                            echo $mat . ' '; ?>
                            </div>
                            <div class="sum"> <?php
                                echo $sum_all; ?>
                            </div>  <?php
                        } ?>
                    </li> <?php
                } ?>
                <li>
                    <div class="mat">
                        <?php echo 'funds: ' . $row_funds . ' z'; ?>
                    </div>
                </li>
            </ul>
        </main>
    </body>
</html>
