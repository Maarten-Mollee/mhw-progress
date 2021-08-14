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
            <?php $edit_adress = 'jewels'; ?>
            <?php include "menu.php"?>
        </header>

        <?php
        $sql = "SELECT name, size, level, posses FROM jewels";
        $result = mysqli_query($conn, $sql); 
        
        $sql_count = "SELECT SUM(posses), SUM(level) FROM jewels";
        $result_count = mysqli_query($conn, $sql_count);
        $row_count = mysqli_fetch_assoc($result_count); ?>

        <main>
            <ul class="jewels_ul">
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
                        
                        <!-- MAKE ARRAY AND FOREACH -->
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
                        
                         <?php
                        if ($_SESSION['edit'] == 1) { ?>
                            <form action="jewels_2.php" method="post">
                                <div class="div_add">
                                    <input type="submit" name="plus" class="plus" value="+">
                                </div>
                                <div class="div_add">
                                    <input type="submit" name="minus" class="minus" value="-">
                                    <input type="hidden" name="jewel_to_edit" value="<?php echo $row['name'] ?>">
                                    <input type="hidden" name="posses_to_edit" value="<?php echo $row['posses'] ?>">
                                </div>
                            </form> <?php
                        } ?>
                    </li> <?php
                } ?> <?php
                if ($_SESSION['edit'] == 1) { ?>
                    <li>
                        <form action="jewels_2.php" method="post">
                            <div>
                                <input type="text" name="name" class="form_name">
                            </div>
                            <div>
                                <input type="text" name="size" class="form_num">
                            </div>
                            <div>
                                <input type="text" name="level" class="form_num">
                            </div>
                            <div>
                                <input type="text" name="posses" class="form_num">
                            </div>
                            <div class="div_add">
                                <input type="submit" name="add" class="form_add" value="+">
                            </div>
                        </form>
                    </li> <?php
                } ?>
            </ul>
        </main>
    </body>
</html>
