<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/messages.css" type="text/css">
        <title>Index</title>
    </head>
    <body>
        <header>
            <?php $edit_adress = 'messages'; ?>
            <?php include "menu.php"?>
        </header>
        <main>

            <?php
            $sql_region = "SELECT * FROM messages";
            $result_region = mysqli_query($conn, $sql_region);



            for ($r = 1; $r <= 6; $r++) {
                for ($n = 1; $n <= 10; $n++) {
                    $m[$r][$n] = '???';
                }
            }

            while ($row = mysqli_fetch_assoc($result_region)) {
                switch ($row['region']) {
                    case 'shrine ruins':
                        $m[1][$row['number']] = $row['message'];
                        break;
                    case 'frost islands':
                        $m[2][$row['number']] = $row['message'];
                        break;
                    case 'flooded forest':
                        $m[3][$row['number']] = $row['message'];
                        break;
                    case 'sandy plains':
                        $m[4][$row['number']] = $row['message'];
                        break;
                    case 'lava caverns':
                        $m[5][$row['number']] = $row['message'];
                        break;
                    case 'rampage':
                        $m[6][$row['number']] = $row['message'];
                        break;
                }
            }

            $sql_count = "SELECT COUNT(*) FROM messages";
            $result = $conn->query($sql_count);
            $count = mysqli_fetch_assoc($result);



            ?>
            count: <?php echo $count['COUNT(*)']; ?> / 60

            <table class="max-width">
                <tr> 
                    <td>
                        <p>shrine ruins</p>
                    </td>
                    <td>
                        <p>frost islands</p>
                    </td>
                    <td>
                        <p>flooded forest</p>
                    </td>
                    <td>
                        <p>sandy plains</p>
                    </td>
                    <td>
                        <p>lava caverns</p>
                    </td>
                    <td>
                        <p>rampage</p>
                    </td> 
                </tr>
                <tr> <?php
                    for ($i = 1; $i <=6; $i++) { ?>
                        <td>
                            <table class="numbers"> <?php
                                for ($u = 1; $u <=10; $u++) { ?>
                                    <td class="message_color<?php if ($m[$i][$u] != '???') {echo '_green';} ?>"> <?php
                                        echo $u; ?>
                                    </td> <?php
                                } ?>
                            </table>
                        </td> <?php
                    } ?>
                </tr>
                <tr> <?php
                    for ($o = 1; $o <=6; $o++) { ?>
                        <td> <?php
                            for ($a = 1; $a <=10; $a++) { ?>
                                <p> <?php
                                    echo $m[$o][$a]; ?>
                                </p> <br> <?php
                            } ?>
                        </td> <?php
                    } ?>
                </tr>
            </table> <?php
            if ($_SESSION['edit'] == 1) { ?>
                <br><br>
                <table>
                    <form action="messages_2.php" method="post">
                        <tr>
                            <td>
                                <input class="long" type="text" name="region" autofocus>
                            </td>
                            <td>
                                <input class="small" type="text" name="number">
                            </td>
                            <td class="big_plus_field">
                                <input type="submit" name="add" value="+">
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <textarea class="big" type="textarea" name="message"></textarea>
                            </td>
                        </tr>
                    </form>
                </table> <?php
            } ?>
        </main>
    </body>
</html>
