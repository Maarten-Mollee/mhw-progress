<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/index.css" type="text/css">
        <link rel="stylesheet" href="css/jquery.css" type="text/css">
        <title>Index</title>
    </head>
    <body>
        <script src="java/jquery.js"></script>
        <script src="java/index.js"></script>
        <header>
            <?php include "menu.php"?>
        </header>
        <main>
        <br><br><br>
            <div class="index">
                <h1>monster hunter rise progress</h1>            
                <br>
                <?php

                $sql_querys = array (
                "SELECT COUNT(*) FROM all_armors WHERE sum_posses = sum", 
                "SELECT COUNT(*) FROM all_armors", 
                "SELECT SUM(posses), SUM(level) FROM jewels", 
                "SELECT SUM(small_crown), SUM(big_crown) FROM monsters", 
                "SELECT COUNT(*) FROM monsters", 
                "SELECT COUNT(*) FROM pictures WHERE picture_posses = 1", 
                "SELECT COUNT(*) FROM pictures", 
                "SELECT COUNT(*) FROM messages");

                $rows = array (
                    
                );

                $sql_count_armor = "SELECT COUNT(*) FROM all_armors WHERE sum_posses = sum";
                $result_armor = $conn->query($sql_count_armor);
                $count_armor = mysqli_fetch_assoc($result_armor);

                $all_count_armor = "SELECT COUNT(*) FROM all_armors";
                $all_armor = $conn->query($all_count_armor);
                $all_armor = mysqli_fetch_assoc($all_armor);

                $sql_count_jewel = "SELECT SUM(posses), SUM(level) FROM jewels";
                $result_jewel = $conn->query($sql_count_jewel);
                $count_jewel = mysqli_fetch_assoc($result_jewel);
                
                $sql_count_crown = "SELECT SUM(small_crown), SUM(big_crown) FROM monsters";
                $result_crown = $conn->query($sql_count_crown);
                $count_crown = mysqli_fetch_assoc($result_crown);
                $crown_sum = $count_crown['SUM(small_crown)'] + $count_crown['SUM(big_crown)'];

                $all_count_crown = "SELECT COUNT(*) FROM monsters";
                $all_query_crown = $conn->query($all_count_crown);
                $all_crown = mysqli_fetch_assoc($all_query_crown);
                $all_sum = $all_crown['COUNT(*)'] * 2;

                $sql_count_pic = "SELECT COUNT(*) FROM pictures WHERE picture_posses = 1";
                $result_pic = $conn->query($sql_count_pic);
                $count_pic = mysqli_fetch_assoc($result_pic);

                $all_count_pic = "SELECT COUNT(*) FROM pictures";
                $all_result_pic = $conn->query($all_count_pic);
                $all_pic = mysqli_fetch_assoc($all_result_pic);

                $sql_count_mess = "SELECT COUNT(*) FROM messages";
                $result_mess = $conn->query($sql_count_mess);
                $count_mess = mysqli_fetch_assoc($result_mess);
                
                ?>
                
                picture count: <?php echo $count_pic['COUNT(*)']; ?> / <?php echo $all_pic['COUNT(*)']; ?> <br>
                message count: <?php echo $count_mess['COUNT(*)']; ?> / 60 <br>
                armor count: <?php echo $count_armor['COUNT(*)']; ?> / <?php echo $all_armor['COUNT(*)']; ?> <br>
                jewel count: <?php echo $count_jewel['SUM(posses)']; ?> / <?php echo $count_jewel['SUM(level)']; ?> <br>
                crown count: <?php echo $crown_sum; ?> / <?php echo $all_sum; ?><br>
                <br>
                to do list:<br>
                <p>remove redundancy in page:</p>
                <p>1. index</p>
                <p>3. all_armor_2</p>
                <p>4. jewels</p>
                <p>5. jewel_details</p>
                <p>6. messages</p>

                <br><p>2. make mysql query functions</p> <br>

                <p>x. nadenken over het maken van damage numbers overzicht</p>
            </div>
        </main>
    </body>
</html>
