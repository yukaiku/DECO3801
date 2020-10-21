<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbStudent.php';
include_once  'includes/dbSchool.php';
$schoolInfo = getByIdSchool($user['school']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profile</title>

    <?php
    include 'css.php';
    ?>
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <?php
        include_once("sideBar.php");
        ?>
        <div role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-4">
            <div style="float:left">
                <img width="150" height="150" src="img/<?= $user['profileImage']; ?>"/><br/>
                <br>
            </div>
            <div style="padding-left:18%">
                <h4><?= $user['username']; ?></h4>
                <div style="margin:1% 0 0 0; font-size:15px;">
                    <label for="selectStatus"><b>Status: </b></label>
                    <select  name="class" id="selectStatus">
                        <option>Online</option>
                        <option>Idle</option>
                        <option>Invisible</option>
                    </select><br><br>
                </div>
                <button style="font-size: 12px;" class="btn btn-outline-dark updateDetails" data-toggle="modal" data-target="#updateDetailsModal">Update Details</button><br><br><br>

            </div>

            <div style="margin-top:3%; font-size:16px;">
                <div class="form-row">
                    <b>Full Name</b><br/>
                    <?= $user['firstname'].' '.$user['lastname']; ?><br/>
                </div>
                <div class="form-row">
                    <b>School</b><br/>
                    <?= $schoolInfo['name']; ?><br/>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php
include 'lastActivity.php';
include "updateTeacherModal.php";
?>
</body>
</html>
