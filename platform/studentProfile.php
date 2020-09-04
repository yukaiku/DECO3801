
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
                    <img width="135" height="150" src="#"/><br/>
                    Change Profile Picture
                </div>
                <div style="padding-left:18%">
                    <h4>Name</h4>
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
                        puppy<br/>
                    </div>
                    <div class="form-row">
                        <b>Full Name</b><br/>
                        German Shephard<br/>
                    </div>
                    <div class="form-row">
                        <b>Grade</b><br/>
                        6<br/>
                    </div>
                    <div class="form-row">
                        <b>Class</b><br/>
                        E<br/>
                    </div>
                    <div class="form-row">
                        <b>School</b><br/>
                        Ironside State School<br/>
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
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }
</script>

</body>
</html>
