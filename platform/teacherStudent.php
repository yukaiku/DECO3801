<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbTeacher.php';
include_once 'includes/dbStudent.php';
include_once 'includes/dbSchool.php';
$studentId = isset($_GET['id']) ? $_GET['id'] : "";
if($studentId == ""){
    header("Location: teacherMain.php");
}
$studentInfo = getByIdStudent($studentId);
$schoolInfo = getByIdSchool($studentInfo['school']);
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
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <?php
        include_once("sideBar.php");
        ?>
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div style="float:left">
                <img width="135" height="150" src="#"/><br/>
                Change Profile Picture
            </div>
            <div style="padding-left:18%">
                <h4><?=$studentInfo['username']?></h4>
                <a type="button" style="font-size: 12px;" class="btn btn-outline-dark" href="#">Change Username</a><br/>
                <div style="margin:5% 0 0 0; font-size:15px;">
                    <b>Status: Online</b>
                    <a type="button" style="font-size: 12px;" class="btn btn-outline-dark" href="#">Change</a><br/>
                    <a type="button" style="font-size: 12px;" class="btn btn-dark" href="studentFriends.php">Friends List</a>
                </div>
            </div>

            <div style="margin-top:3%; font-size:16px;">
                <div class="form-row">
                    <b>Nickname</b>
                    <a type="button" style="font-size: 12px;" class="btn btn-outline-dark" href="#">Change</a><br/>
                    <?=$studentInfo['nickname']?><br/>
                </div>
                <div class="form-row">
                    <b>Full Name</b><br/>
                    <?=$studentInfo['firstname']?> <?=$studentInfo['lastname']?><br/>
                </div>
                <div class="form-row">
                    <b>Grade</b><br/>
                    <?=$studentInfo['grade']?><br/>
                </div>
                <div class="form-row">
                    <b>Class</b><br/>
                    <?=$studentInfo['class']?><br/>
                </div>
                <div class="form-row">
                    <b>School</b><br/>
                    <?=$schoolInfo['name']?><br/>
                </div>
                <div class="form-row">
                    <input type="hidden" value="<?= $studentInfo['id']?>" id="studentId" name="studentId">
                    <button class="btn btn-danger mb-2" style="text-align: center" id="resetPasswordButton">Reset Password</button>
                </div>
            </div>
            <div id="mainFooter" style="bottom:0; position: fixed;">
                <a class="btn btn-primary mb-2" style="text-align: center" href="javascript:history.back()">Back</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php
include 'lastActivity.php';
?>
<script type="text/javascript">

    $(document).ready(function() {

        $("#resetPasswordButton").click(function(){
            var studentId = $("#studentId").val();
            var password = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            deleteClass(studentId, password);
        });

        function deleteClass(studentId, password){
            $.post("ajax/updateUser.php",
                {
                    id: studentId,
                    pwd: password
                },
                function(result){
                    alert(result);
                });
        }
    });
</script>

</body>
</html>
