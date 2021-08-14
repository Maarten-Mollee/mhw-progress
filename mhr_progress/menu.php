<?php ?>

<nav>
    <div class="navbar">
        <div class="admin_dropdown">
            <button class="dropbutton">---</button>
            <div class="dropdown">
                <a href="../image_library/index.php">image searcher</a>
                <a href="index.php">mhr progress</a>
                <a href="../one_piece_project/pages/index.php">one piece theory</a>
                <a href="../dagboek/dagboek.php">dagboek</a>
            </div>
        </div>
        <a href="index.php">Index</a>
        <div class="admin_dropdown">
            <button class="dropbutton">armor</button>
            <div class="dropdown">
                <a href="my_armor.php">my armors</a>
                <a href="all_armor.php">all armors</a>
            </div>
        </div>
        <div class="admin_dropdown">
            <button class="dropbutton">jewels</button>
            <div class="dropdown">
                <a href="jewels.php">jewels</a>
                <a href="jewel_details.php">details</a>
            </div>
        </div>
        <a href="crowns.php">crowns</a>
        <a href="pictures.php">pictures</a>
        <a href="messages.php">messages</a>
        <div class="admin_dropdown">
            <button class="dropbutton">checklist</button>
            <div class="dropdown">
                <a href="armor_checklist.php">armor checklist</a>
                <a href="jewel_checklist.php">jewelchecklist</a>
                <a href="all_checklist.php">all checklist</a>
            </div>
        </div>
        <a href="achievement.php">achievements</a>
        <?php if ($_SESSION['edit'] == 0) { ?>
            <a href="edit_session.php?page=<?php echo $edit_adress; ?>&edit=1">edit</a> <?php
        } else if ($_SESSION['edit'] == 1) { ?>
            <a href="edit_session.php?page=<?php echo $edit_adress; ?>&edit=0">view</a> <?php
        } ?>
        <!-- <a href="java_shit.php">java shit</a> -->
    </div>
</nav>