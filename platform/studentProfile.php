<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbStudent.php';
include_once  'includes/dbSchool.php';
$schoolInfo = getByIdSchool($user['school']);
$studentId = isset($_GET['id']) ? $_GET['id'] : 0;
$string = "";
if($studentId == 0){
    echo "<script type='text/javascript'>history.back();</script>";
}
//prevents student from going other profiles
if($status == "student" and $user['id'] != $studentId){
    echo "<script type='text/javascript'>history.back();</script>";
}
$studentInfo = getByIdStudent($studentId);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <?php
        include_once("sideBar.php");
        ?>
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div style="float:left">
                    <img width="150" height="150" src="img/<?=$studentInfo['profileImage'];?>"/><br/>
                    <button style="font-size: 12px;" class="btn btn-outline-dark updateDetails" data-toggle="modal" data-target="#updateDetailsModal">Change Profile Image</button><br/>
                </div>
                <div style="padding-left:18%">
                    <h4><?= $studentInfo['username']; ?></h4>
                    <div style="margin:1% 0 0 0; font-size:15px;">
                        <label for="selectStatus"><b>Status: </b></label>
                        <select  name="class" id="selectStatus">
                            <option>Online</option>
                            <option>Idle</option>
                            <option>Invisible</option>
                        </select><br/><br/>
                        <a type="button" style="font-size: 12px;" class="btn btn-dark" href="studentFriends.php">Friends List</a>
                    </div>
                </div>

                <div style="margin-top:3%; font-size:16px;">
                    <div class="form-row">
                        <br>
                        <b>Full Name</b><br/>
                        <?= $studentInfo['firstname'].' '.$studentInfo['lastname']; ?><br/>
                    </div>
                    <div class="form-row">
                        <b>Nickname</b>
                        <?= $studentInfo['nickname']; ?><br/>
                    </div>
                    <div class="form-row">
                        <b>Grade</b><br/>
                        <?= $studentInfo['grade']; ?><br/>
                    </div>
                    <div class="form-row">
                        <b>Class</b><br/>
                        <?= $studentInfo['class']; ?><br/>
                    </div>
                    <div class="form-row">
                        <b>School</b><br/>
                        <?= $schoolInfo['name']; ?><br/>
                    </div>
                    <div class="form-row">
                        <button style="font-size: 12px;" class="btn btn-outline-dark updateDetails" data-toggle="modal" data-target="#updateDetailsModal">Update Details</button><br/>
                    </div>
                </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.5.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/collapsibleSideBar.js"></script>
<?php
include "updateStudentModal.php";
?>
</body>
</html>
