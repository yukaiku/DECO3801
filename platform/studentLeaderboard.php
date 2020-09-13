<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbStudent.php';
include_once 'includes/dbStudentProgress.php';
$gameId = isset($_GET['gameId']) ? $_GET['gameId'] : "1";
$studentRecords = getStudentRecordsProgress($gameId, $user['school']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Leaderboard</title>

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
            <div class="row">
                <h1><b>Who Lost Roger?</b></h1>
            </div>
            <div id="sub-heading">
                <h4><b>Leaderboard</b></h4>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Percentage</th>
                        <th>Total Score</th>
                        <th>Rank</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $rank = 1;
                    foreach ($studentRecords as $student => $record){

                        echo "<tr>";

                        echo "<td>";
                        echo $record['firstname'] . " " . $record['lastname'];
                        echo "</td>";
                        echo "<td>";
                        echo round($record['percentage'],2) . "%";
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
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.5.0.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/collapsibleSideBar.js"></script>
</body>
</html>