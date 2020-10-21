<?php
include_once "includes/dbGame.php";
$games = getAllGame('subject');
?>
<nav class="col-md-2 d-none d-md-block" style="background-color: #96DFD8; padding: 0px">
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
                //echo "<div class='breakline'></div>";
            }
            echo '<div class="content" style ="background-color: #D55464;">';
            echo "<a href='gameInfo.php?gameId={$rowDetails['id']}' class='btn' style='color: white'>{$rowDetails['name']}</a>";
            echo '</div>';


        }
        ?>

        <ul>
            <div class="row bottom-navbar">
                <div class="col-lg-3">
                    <img src="img/<?=$user['profileImage'];?>" style="width: 50px; height: 50px;" >
                </div>
                <div class="col-lg-9">
                    <?php if ($status == "student"){
                        echo '<a type="button" class="btn" href="studentProfile.php?id='.$user['id'].'">';
                    }else{
                        echo '<a type="button" class="btn" href="teacherProfile.php">';
                    }
                    echo "<b>{$user['username']}</b>";
                    ?>
                    </a>
                    <div clas="row">
                        Status
                    </div>
                    <div clas="row">
                        <a class="onlineButton">Chat</a> |
                        <a href="logoutHandler.php">Log Out</a>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</nav>
