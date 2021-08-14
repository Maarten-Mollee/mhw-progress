<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/small_lists.css" type="text/css">
        <title>Index</title>
    </head>
    <body>
        <header>
            <?php $edit_adress = 'crowns'; ?>
            <?php include "menu.php"?>
        </header>
        <main>

        <?php
            $sql = "SELECT * FROM monsters";
            $result = mysqli_query($conn, $sql);
            $queryresult = mysqli_num_rows($result);

            $sql_count_crown = "SELECT SUM(small_crown), SUM(big_crown) FROM monsters";
            $result_crown = $conn->query($sql_count_crown);
            $count_crown = mysqli_fetch_assoc($result_crown);
            $small_crown = $count_crown['SUM(small_crown)'];
            $big_crown = $count_crown['SUM(big_crown)'];

            $all_count_crown = "SELECT COUNT(*) FROM monsters";
            $all_query_crown = $conn->query($all_count_crown);
            $all_crown = mysqli_fetch_assoc($all_query_crown);
            $all_sum = $all_crown['COUNT(*)'] * 2;

            ?>
            <table>
                <tr class="crown_color<?php if ($small_crown + $big_crown == 80) echo'_green' ?>">
                    <td>
                        <p> <?php echo $all_sum; ?> </p>
                    </td>
                    <td>
                        <p> monster </p>
                    </td>
                    <td>
                        <p> <?php echo $big_crown; ?></p>
                    </td>
                    <td>
                        <p> <?php echo $small_crown; ?> </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p> id </p>
                    </td>
                    <td>
                        <p> monster </p>
                    </td>
                    <td>
                        <p> big crown</p>
                    </td>
                    <td>
                        <p> small crown </p>
                    </td>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr class="crown_color<?php if ($row['big_crown'] == 1 && $row['small_crown'] == 1) { echo '_green'; } ?>">
                        <td>
                            <p> <?php echo $row['monster_id']; ?> </p>
                        </td>
                        <td>
                            <p> <?php echo $row['monster_name']; ?> </p>
                        </td>
                        <td class="crown_color<?php if ($row['big_crown'] == 1) echo '_green'; ?>">
                            <p> <?php echo $row['big_crown']; ?> </p>
                        </td>
                        <td class="crown_color<?php if ($row['small_crown'] == 1) echo '_green'; ?>">
                            <p> <?php echo $row['small_crown']; ?> </p>
                        </td> <?php
                        if ($_SESSION['edit'] == 1) { ?>
                            <form name="edit" action="crowns_2.php" method="post">
                                <td class="check_td">
                                    <input class="check" type="checkbox" name="edit_big_crown">
                                </td>
                                <td class="check_td">
                                    <input class="check" type="checkbox" name="edit_small_crown">
                                </td>
                                <td class="edit_delete">
                                    <input class="big_plus" type="submit" name="edit" value="EDIT">
                                    <input type="hidden" name="monster_to_edit" value="<?php echo $row['monster_name'] ?>">
                                </td>
                                <td class="edit_delete">
                                    <input class="big_plus" type="submit" name="delete" value="DEL">
                                    <input type="hidden" name="monster_to_edit" value="<?php echo $row['monster_name'] ?>">
                                </td>
                            </form> <?php
                        } ?>
                    </tr> <?php
                } ?>
            </table>
            <table>
                <form action="crowns_2.php" method="post">
                    <tr>
                        <td>
                            <input class="small" type="text" name="monster_id">
                        </td>
                        <td>
                            <input class="mid" type="text" name="monster_name">
                        </td>
                        <td>
                            <input class="small" type="text" name="big_crown">
                        </td>
                        <td>
                            <input class="small" type="text" name="small_crown">
                        </td>
                        <td>
                            <input class="small" type="submit" name="add" value="+">
                        </td>
                    </tr>
                </form>
            </table>
        </main>
    </body>
</html>
