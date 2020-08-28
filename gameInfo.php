
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Game Name here</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/teacher.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul>
                    <h1>Hi ....</h1>
                </ul>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file"></span>
                            Orders
                        </a>

                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Saved reports</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Current month
                        </a>
                    </li>
                </ul>
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
                                Chat   |  <a href="index.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>

        </nav>

        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <!--
                Code the UI of the profile page
                -->
            <div class="row" id="gameName">
                <h1>Game Name</h1>
            </div>
            <div class="row" id="subject">
                <h3>Subject: XX</h3>
            </div>
            <div class="row" id="description">
                <h3>Description:</h3>
                <p>
                    lorem ipsum
                </p>
                <p id="genre">
                    Genre:
                </p>
                <p id="grade">
                    Grade: x
                </p>

            </div>
            <a class="btn btn-primary mb-2" style="text-align: center" href="game.php">Play</a>
            <br>
            <a class="btn btn-primary mb-2" style="text-align: center" href="teacherStudentProgressByClass.php">Student's Progress</a>
            <div id="mainFooter" style="bottom:0; position: fixed;">
                <a class="btn btn-primary mb-2" style="text-align: center" href="javascript:history.back()">Back</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.5.0.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
