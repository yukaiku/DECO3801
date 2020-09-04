<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbTeacher.php';
include_once 'includes/dbStudent.php';
include_once 'includes/dbStudentProgress.php';
$gameId = isset($_GET['gameId']) ? $_GET['gameId'] : "1";
$gameInfo = getByIdGame($gameId);
$gameName = $gameInfo['name'];
$gameSubject = $gameInfo['subject'];
$gameDescription = $gameInfo['description'];
$gameGrade = $gameInfo['grade'];
$gameGenre = $gameInfo['genre'];
$class = isset($_GET['class']) ? $_GET['class'] : "1";
$grade = isset($_GET['grade']) ? $_GET['grade'] : "A";
$studentRecords = getStudentRecordsProgress($gameId, $user['school'], $class, $grade);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Student Progress by Class</title>

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
            <div class="row" id="gameName">
                <h1><?=$gameName?></h1>
            </div>
            <div class="row" id="className">
                <h1>Class: <?=$grade ?><?=$class ?></h1>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>first Name</th>
                        <th>Progress</th>
                        <th>Score</th>
                        <th>Rank</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $rank = 1;
                    foreach ($studentRecords as $student => $record){

                        echo "<tr>";

                        echo "<td>";
                        echo $record['username'];
                        echo "</td>";
                        echo "<td>";
                        echo $record['firstname'];
                        echo "</td>";
                        echo "<td>";
                        echo $record['percentage'];
                        echo "</td>";
                        echo "<td>";
                        echo $record['score'];
                        echo "</td>";
                        echo "<td>";
                        echo $rank;
                        echo "</td>";

                        echo "</tr>";
                        $rank +=1;
                    }
                    ?>
                    </tbody>
                </table>
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
<script src="js/jquery-3.5.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/collapsibleSideBar.js"></script>

</body>
</html>
