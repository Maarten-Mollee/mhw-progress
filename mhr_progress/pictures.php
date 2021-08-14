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
            <?php $edit_adress = 'pictures'; ?>
            <?php include "menu.php"?>
        </header> 
        <main>
        <?php
            $sql = "SELECT * FROM pictures";
            $result = mysqli_query($conn, $sql);
            $queryresult = mysqli_num_rows($result);

            $sql_count_pic = "SELECT COUNT(*) FROM pictures WHERE picture_posses = 1";
            $result_pic = $conn->query($sql_count_pic);
            $count_pic = mysqli_fetch_assoc($result_pic);

            $all_count_pic = "SELECT COUNT(*) FROM pictures";
            $all_result_pic = $conn->query($all_count_pic);
            $all_pic = mysqli_fetch_assoc($all_result_pic);

            ?>
            <table>
                <tr class="crown_color<?php if ($count_pic['COUNT(*)'] == $all_pic['COUNT(*)']) echo'_green' ?>">
                    <td>
                        <p> <?php echo $count_pic['COUNT(*)']; ?> </p>
                    </td>
                    <td>
                        <p> out of </p>
                    </td>
                    <td>
                        <p> <?php echo $all_pic['COUNT(*)']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="head_td">
                        <p> id</p>
                    </td>
                    <td class="head_td">
                        <p> type </p>
                    </td>
                    <td class="head_td">
                        <p> name</p>
                    </td>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr class="crown_color<?php if ($row['picture_posses'] == 1) echo '_green'; ?>">
                        <td class="small">
                            <p> <?php echo $row['picture_id']; ?> </p>
                        </td>
                        <td class="mid">
                            <p> <?php echo $row['picture_type']; ?> </p>
                        </td>
                        <td>
                            <p> <?php echo $row['picture_name']; ?> </p>
                        </td> <?php
                        if ($_SESSION['edit'] == 1) { ?>
                            <form name="edit" action="pictures_2.php" method="post">
                                <td class="check_td">
                                    <input class="check" type="checkbox" name="edit_picture">
                                </td>
                                <td class="edit_delete">
                                    <input class="big_plus" type="submit" name="edit" value="EDIT">
                                    <input type="hidden" name="picture_name" value="<?php echo $row['picture_name'] ?>">
                                </td>
                            </form> <?php
                        } ?>
                    </tr> <?php
                } ?>
            </table>
            <table> <?php
                if ($_SESSION['edit'] == 1) { ?>
                    <form action="pictures_2.php" method="post">
                        <tr>
                            <td>
                                <input class="small" type="text" name="picture_id">
                            </td>
                            <td>
                                <input class="mid" type="text" name="picture_type">
                            </td>
                            <td>
                                <input class="mid_2" type="text" name="picture_name">
                            </td>
                            <td>
                                <input class="small" type="text" name="picture_posses">
                            </td>
                            <td>
                                <input class="small" type="submit" name="add" value="+">
                            </td>
                        </tr>
                    </form> <?php
                } ?>
            </table>
        </main>
    </body>
</html>
