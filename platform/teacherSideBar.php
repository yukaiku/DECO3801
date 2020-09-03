<?php
$games = getAllGame('subject');
?>
<nav class="col-md-2 d-none d-md-block bg-light ">
    <div class="sidebar-sticky">
        <ul>
            <h2>Hi <?= $user['firstname']; ?></h2>
        </ul>
<<<<<<< HEAD
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
=======
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <button class="collapsible">English</button>
            <div class="content">
                <p>Who Lost Roger?</p>
            </div>
            <button class="collapsible">Mathematics</button>
            <div class="content">
                <p>Puzzle Master</p>
            </div>
>>>>>>> origin/student_platform

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
                    <div clas="row">
                        Name
                    </div>
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