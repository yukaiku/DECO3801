<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbTeacher.php';
include_once 'includes/dbWhoLostRoger.php';
$gameId = isset($_GET['gameId']) ? $_GET['gameId'] : "1";
$class = isset($_GET['class']) ? $_GET['class'] : "1";
$grade = isset($_GET['grade']) ? $_GET['grade'] : "A";
$gameInfo = getByIdGame($gameId);
if($gameInfo == ""){ //if id returns blank, load game 1
    $gameInfo = getByIdGame(1);
    $gameId = 1;
}
if($gameId == 1){
    include_once 'includes/dbWhoLostRoger.php';
}
$gameName = $gameInfo['name'];
$gameSubject = $gameInfo['subject'];
$gameDescription = $gameInfo['description'];
$gameGrade = $gameInfo['grade'];
$gameGenre = $gameInfo['genre'];
$studentRecords = getHighScoreOfEachStudentByClassAndGrade($user['school'], $class, $grade);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Student Progress by Class</title>

    <?php
    include 'css.php';
    ?>
<!--    Charts CSS -->
    <link href="css/Chart.min.css" rel="stylesheet">
    <style>

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
        .tab button.active:after{
            content: "";
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
            <div class="row" id="gameName">
                <h1><?=$gameName?></h1>
            </div>
            <div class="row" id="className">
                <h1>Class: <?=$grade ?><?=$class ?></h1>
                <container>
                    <div class="tab">
                        <button class="tablinks active" onclick="opeTab(event, 'concrete')">Concrete Nouns</button>
                        <button class="tablinks" onclick="opeTab(event, 'collective')">Collective Nouns</button>
                        <button class="tablinks" onclick="opeTab(event, 'countable')">Countable Nouns</button>
                    </div>
                    <?PHP
                    $concreteArr = playCount($user['school'], $class, $grade, 5,1);
                    $collectiveArr = playCount($user['school'], $class, $grade, 10,6);
                    $countableArr = playCount($user['school'], $class, $grade, 15,11);
                    ?>
                    <div id="concrete" class="tabcontent" style="display: block">
                        <h4 style="padding-top: 2%">
                            Main Learning Objective: To learn concrete nouns
                        </h4>
                        <div class="playCount">
                            <div class="playCountHeader">
                                <h5>Number of times played: </h5>
                            </div>
                            <div class="playCounterBody" style="width: 50%">
                                <canvas id= "concretePlayCountChart" class="playCountChart" width="50%" height="20%"></canvas>
                            </div>
                        </div>
                    </div>

                    <div id="collective" class="tabcontent">
                        <div class="playCountHeader">
                            <h5>Number of times played: </h5>
                        </div>
                        <div class="playCounterBody" style="width: 50%">
                            <canvas id= "collectivePlayCountChart" class="playCountChart" width="50%" height="20%"></canvas>
                        </div>
                    </div>

                    <div id="countable" class="tabcontent">
                        <div class="playCountHeader">
                            <h5>Number of times played: </h5>
                        </div>
                        <div class="playCounterBody" style="width: 50%">
                            <canvas id= "countablePlayCountChart" class="playCountChart" width="50%" height="20%"></canvas>
                        </div>
                    </div>

                    <div style="text-align: center; padding-top: 5%">
                        <a class="btn btn-primary mb-2" style="text-align: center" href="studentsProgress.php?grade=<?=$grade?>&class=<?=$class?>">Student's Progress</a>
                    </div>

                </container>
                <div id="mainFooter" style="bottom:0; position: fixed;">
                    <a class="btn btn-primary mb-2" style="text-align: center" href="teacherMain.php">Back</a>
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
<!--    Charts JS-->
    <script src="js/Chart.min.js"></script>
    <script>
        var activeTab = "concrete";
        $(document).ready(function(){
            showGraph(activeTab);

            var CPCCD = new Chart(concretePlayCountChart, {
                type: 'bar',
                data: data,
                options: options
            });
        });
        // PlayCount Chart
        function showGraph(activeTab) {
            var month = [];
            var playCount = [];
            if(activeTab == "concrete"){
                <?php
                echo "var chartDataArr = ".json_encode($concreteArr).";";
                ?>
            }else if (activeTab == "countable"){
                <?php
                echo "var chartDataArr = ".json_encode($countableArr).";";
                ?>
            }else if (activeTab == "collective"){
                <?php
                echo "var chartDataArr = ".json_encode($collectiveArr).";";
                ?>
            }

            console.log(chartDataArr);
            for (var i in chartDataArr) {
                month.push(chartDataArr[i].month);
                playCount.push(chartDataArr[i].playCount);
            }
            var chartdata = {
                labels: month,
                datasets: [
                    {
                        label: 'Play Count',
                        backgroundColor: '#49e2ff',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: playCount
                    }
                ],
            };
            var graphTarget = $("#" + activeTab + "PlayCountChart");

            var barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        function opeTab(evt, tabType) {
            var i, tabcontent, tablinks;
            //Hides all tabs
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            //get all tab links
            tablinks = document.getElementsByClassName("tablinks");
            //remove all active tabs
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            //
            document.getElementById(tabType).style.display = "block";
            //set active tab
            evt.currentTarget.className += " active";
            activeTab = tabType;
            showGraph(activeTab);
        }
    </script>

</body>
</html>
