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
                <b style="float:left;width:80%"><h4>You have 3 friends.</h4></b>
                <a type="button" style="float:right; width:auto;font-size: 15px;" class="btn btn-outline-dark" href="#">Chat (1 online)</a>
            </div>
            <div class="body-content">
                <h6>Friends</h6>
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
            <a style="font-size: 10px;" href="studentFriendsMore.php">See More...</a><br/>
            <div class="body-content">
                <h6>Classmates</h6>
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
                <div id="box">
                    <img src="#"/><br/>
                    schoolsux111
                </div>
                <div id="box">
                    <img src="#"/><br/>
                    ihatevapour
                </div>
                <div id="box">
                    <img src="#"/><br/>
                    mercyHEALPLS
                </div>
            </div>
            <a style="font-size: 10px;" href="#">See More...</a><br/>
            <div class="body-content">
                <h6>Teachers</h6>
                <div id="box">
                    <img src="#"/><br/>
                    mrsapplepie
                </div>
            </div>
            <div id="mainFooter" style="bottom:0; position: fixed;">
                <a class="btn btn-primary mb-2" style="text-align: center" href="javascript:history.back()">Back</a>
            </div>
        </div>
    </div>
</div>
</body>