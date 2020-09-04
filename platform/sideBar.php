<?php
include_once "includes/dbGame.php";
$games = getAllGame('subject');
?>
<nav class="col-md-2 d-none d-md-block bg-light ">
    <div class="sidebar-sticky">
        <ul>
            <h2>Hi <?= $user['firstname']; ?></h2>
        </ul>
        <?php
        if($status == "teacher"){
            echo '<ul style="background-color: grey; padding-top: 10%; padding-bottom: 10%; margin-bottom: 0">
                        <a href="teacherMain.php" style="color:white !important;">DashBoard</a>
                  </ul>';
        }
        ?>


        <?php
        $subject = "";
        $loopCount = 0;
        foreach($games as $row => $rowDetails ){
            if($rowDetails['subject'] != $subject){
                $subject = $rowDetails['subject'];
                echo "<button class='collapsible'>{$rowDetails['subject']}</button>";
            }
            echo '<div class="content" style ="background-color: darkgrey;">';
            echo "<a href='gameInfo.php?gameId={$rowDetails['id']}'>{$rowDetails['name']}</a>";
            echo '</div>';


        }
        ?>
        <!--        <button class="collapsible">English</button>-->
        <!--        <div class="content">-->
        <!--            <p>Who Lost Roger?</p>-->
        <!--        </div>-->
        <!--        <button class="collapsible">Mathematics</button>-->
        <!--        <div class="content">-->
        <!--            <p>Puzzle Master</p>-->
        <!--        </div>-->

        <ul>
            <div class="row bottom-navbar">
                <div class="col-lg-3">
                    <img src="thmisds">
                </div>
                <div class="col-lg-9">
                    <?php if ($status == "student"){
                        echo '<a type="button" class="btn" href="studentProfile.php">';
                    }else{
                        echo '<a type="button" class="btn" href="teacherProfile.php">';
                    }?>
                        <b>Name</b>
                    </a>
                    <div clas="row">
                        Status
                    </div>
                    <div clas="row">
                        Chat   |  <a href="logoutHandler.php">Log Out</a>
                    </div>
                </div>
            </div>
        </ul>
    </div>

</nav>