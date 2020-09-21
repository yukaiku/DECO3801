<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbFriends.php';
include_once 'includes/dbStudent.php';
$StudentFriendInfo = getByUserIdFriendship($user['id']);
$classmates = getByGradeClassStudent($user['grade'],$user['class'],$user['school']);
//$classmates = getClassmates($user['id'],$user['grade'],$user['class']);
//$teachers = getStudentTeacher($user['id']);
$teachers = getBySchoolTeacher($user['school']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Profile</title>
    <?php
    include 'css.php';
    ?>
    <style>
        img{
            width:60px;
            height:70px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php
        include_once("sideBar.php");
        ?>
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="row" id="friendsRow">
                <b style="float:left;width:80%"><h4>You have 3 friends.</h4></b>
                <button class="onlineButton" style="float:right; width:auto;font-size: 15px;" class="btn btn-outline-dark" id="onlineButton">Chat (1 online)</button>
            </div>
            <div class="body-content">
                <h6>Friends</h6>
                    <?php
                    $friendsLoop = 0;
                    foreach ($StudentFriendInfo as $studentFriend){
                        echo '<div id="box"><img src=""/><br/>';
                        echo $studentFriend['username'];
                        echo '</div>';
                        if($friendsLoop > 3){
                            break;
                        }
                    }?>
            </div>
            <a style="font-size: 10px;" href="studentFriendsMore.php">See More...</a><br/>
            <div class="body-content">
                <h6>Classmates</h6>
                <?php
                $classmateLoop = 0;
                foreach ($classmates as $classmates){
                    echo '<div id="box"><img src="#"/><br/>';
                    echo $classmates['username'];
                    echo '</div>';
                    $classmateLoop ++;
                    if($classmateLoop > 3){
                        break;
                    }
                }?>
            </div>
            <a style="font-size: 10px;" href="#">See More...</a><br/>
            <div class="body-content">
                <h6>Teachers</h6>
                <?php foreach ($teachers as $teachers){
                    echo '<div id="box"><img src="#"/><br/>';
                    echo $teachers['firstname'];
                    echo " ";
                    echo $teachers['lastname'];
                    echo '</div>';
                }?>
            </div>
            <div id="mainFooter" style="bottom:0; position: fixed;">
                <a class="btn btn-primary mb-2" style="text-align: center" href="javascript:history.back()">Back</a>
            </div>
        </div>
    </div>
</div>
<?php
include "lastActivity.php";
?>
</body>
</html>