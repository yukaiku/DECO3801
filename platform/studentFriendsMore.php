<?php
include_once "includes/checkLoginStatusForBoth.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Home</title>

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
            <div class="row">
                <b style="float:left;width:80%"><h4>Friends</h4></b>
                <button class="onlineButton" style="float:right; width:auto;font-size: 15px;" class="btn btn-outline-dark" id="onlineButton">Chat (1 online)</button>
            </div>
            <div class="body-content">
                <h6>Class 6E</h6>
                <div id="box">
                    <img src="#"/><br/>
                    fortnite3
                </div>
                <div id="box">
                    <img src="#"/><br/>
                    sunshinegal08
                </div>
                <div id="box">
                    <img src="#"/><br/>
                    bobbyBOB
                </div>
            </div>
            <div id="mainFooter" style="bottom:0; position: fixed;">
                <a class="btn btn-primary mb-2" style="text-align: center" href="javascript:history.back()">Back</a>
            </div>
        </div>
    </div>
</div>
<?php
include 'lastActivity.php';
?>
</body>
</html>
