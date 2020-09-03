
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Home</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <?php
        include_once("studentSideBar.php");
        ?>
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="row">
                <h1><b>Who Lost Roger?</b></h1>
            </div>
            <div class="row" id="searchbar-row">
                <h4>Subject: English</h4>
            </div>

            <div>
                <h4>Description:</h4>
                <p>
                    <h6>
                    Your name is Roger ... that's all you know. You wake up in an unknown room, and you don't know who you are,
                    or where you came from. The house you are in has a weird vibe, and you need to find out who you are, and
                    escape the house before it's too late ...
                    </h6>
                </p>
                <p><h7>Genre: Thriller, Hidden Objects <br/>Grade: 6</h7></p>
                <ul class="navbar-nav" style="padding:1% 0 1% 0">
                    <li class="nav-item text-nowrap">
                        <a type="button" class="btn btn-success" href="#">Play</a>
                    </li>
                </ul>
                <ul class="navbar-nav" style="padding:1% 0 1% 0">
                    <li class="nav-item text-nowrap">
                        <a type="button" class="btn btn-primary" href="studentLeaderboard.php">Leaderboard</a>
                    </li>
                </ul>
                <ul class="navbar-nav" style="padding:1% 0 1% 0">
                    <li class="nav-item text-nowrap">
                        <a type="button" class="btn btn-primary" href="#.php">Achievements</a>
                    </li>
                </ul>
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
