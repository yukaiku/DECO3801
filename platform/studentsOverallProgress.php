<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbTeacher.php';
$gameId = isset($_GET['gameId']) ? $_GET['gameId'] : "1";
$class = isset($_GET['class']) ? $_GET['class'] : "1";
$grade = isset($_GET['grade']) ? $_GET['grade'] : "A";
$gameInfo = getByIdGame($gameId);
if($gameInfo == ""){ //if id returns blank, load game 1
    $gameInfo = getByIdGame(1);
    $gameId = 1;
}
if($gameId == 1){ //one new if for each game id
    include_once 'includes/dbWhoLostRoger.php';
}
$gameName = $gameInfo['name'];
$gameSubject = $gameInfo['subject'];
$gameDescription = $gameInfo['description'];
$gameGrade = $gameInfo['grade'];
$gameGenre = $gameInfo['genre'];

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
            border: 1px solid #96DFD8;
            background-color: #fff;
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
            background-color: #d3f9f5;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #96DFD8;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #96DFD8;
            border-top: none;
            background-color: #fff;
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
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 overflow-auto">
            <div style="padding-top: 80em;">
            <div class="row" id="gameName">
                <h1><?=$gameName?></h1>
            </div>
            <div class="row" id="className">
                <h1>Class: <?=$grade ?><?=$class ?></h1>
                <container>
                    <div class="tab">
                        <button class="tablinks active" onclick="openTab(event, 'concrete')">Concrete Nouns</button>
                        <button class="tablinks" onclick="openTab(event, 'collective')">Collective Nouns</button>
                        <button class="tablinks" onclick="openTab(event, 'countable')">Countable Nouns</button>
                    </div>
                    <?PHP
                    if(function_exists ( "playCount" )){
                        $concreteArr = playCount($user['school'], $class, $grade, 5,1);
                        $collectiveArr = playCount($user['school'], $class, $grade, 10,6);
                        $countableArr = playCount($user['school'], $class, $grade, 15,11);
                    }
                    ?>
                    <div id="concrete" class="tabcontent overflow-auto" style="display: block">
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
                        <div class="learningOutComes">
                            <h5>Learning Outcomes</h5>
                            <p>Please note that learning outcomes are determined by the consistency of the class’s learning through students of that class
                                playing the game. The bar adjusts according to the child’s skill/knowledge that fulfills each outcome.</p>
                            <div class="learningOutComesLevels" style="width: 80%">
                                <canvas class= "outCome1" width="100%" height="50%"></canvas>
                                <canvas class= "outCome2" width="100%" height="50%"></canvas>
                                <canvas class= "outCome3" width="100%" height="50%"></canvas>
                                <canvas class= "outCome4" width="100%" height="50%"></canvas>
                                <canvas class= "outCome5" width="100%" height="50%"></canvas>
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
                    <div style="text-align: center; padding-top: 5%; padding-bottom: 5%">
                        <a class="btn-all" style="text-align: center" href="studentsProgress.php?grade=<?=$grade?>&class=<?=$class?>&gameId=<?=$gameId?>">Back</a>
                    </div>
                </container>
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
        });
        // PlayCount Chart
        function showGraph(activeTab) {
            var month = [];
            var playCount = [];
            var chartDataArr = [];
            <?php
            echo 'if(activeTab == "concrete"){';
            if(isset($concreteArr)){
                echo "var chartDataArr = ".json_encode($concreteArr).";";
            }
            echo '}else if (activeTab == "collective"){';
            if(isset($collectiveArr)){
                echo "var chartDataArr = ".json_encode($collectiveArr).";";
            }
            echo '}else if (activeTab == "countable"){';
            if(isset($countableArr)){
                echo "var chartDataArr = ".json_encode($countableArr).";";
            }
            echo "}";
            ?>
            for (var i in chartDataArr) {
                month.push(chartDataArr[i].month);
                playCount.push(chartDataArr[i].playCount);
            }
            var chartdata = {
                labels: month,
                datasets: [
                    {
                        label: 'Play Count',
                        backgroundColor: '#96DFD8',
                        borderColor: '#96DFD8',
                        hoverBackgroundColor: '#D55464',
                        hoverBorderColor: '#D55464',
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
            showOutComeGraph(activeTab);
        }
        function showOutComeGraph(activeTab) {
            var maxLevel;
            var lowestLevel;
            if(activeTab == "concrete"){
                <?php
                    if(function_exists('getLearningOutComes')){
                        $learningOutcomes = getLearningOutComes($user['school'], $class, $grade, 5,1);
                    }
                ?>
            }else if (activeTab == "collective"){
                maxLevel = 10;
                lowestLevel = 6;
            }else if (activeTab == "countable"){
                maxLevel = 15;
                lowestLevel = 11;

            }
            <?php
                if(function_exists('getLearningOutComes')){
                    $levelsArr = [];
                    $level = 1;
                    $aNoun = [];
                    $labelNames = [];
                    foreach($learningOutcomes as $learningOutcome){

                        //print and reset nouns every level
                        if($level != $learningOutcome['level']){
                            $nounCount = (json_encode(array_values($aNoun)));
                            echo " drawHorizontalGraph(". json_encode($labelNames) . "," . $nounCount . "," . $level . "); ";
                            $level = $learningOutcome['level'];
                            $aNoun = [];
                            $labelNames = [];
                        }
                        $nounsClicked = explode("|",$learningOutcome['nounsClicked']);
                        foreach ($nounsClicked as $key => $value) {
                            if(!array_key_exists($value, $aNoun)){
                                $aNoun[$value] = 1;
                                array_push($labelNames,$value);
                            }else{
                                $aNoun[$value]++;
                            }
                        }
                        //last level and row reached
                        if( !next( $learningOutcomes ) ) {
                            $nounCount = (json_encode(array_values($aNoun)));
                            echo " drawHorizontalGraph(". json_encode($labelNames) . "," . $nounCount . "," . $level . "); ";
                        }
                    }
                }
            ?>
        }

        function drawHorizontalGraph(labelName, nounCount ,level){
            var chartdata = {
                labels: labelName,
                datasets: [
                    {
                        label: 'Times Clicked',
                        backgroundColor: '#96DFD8',
                        borderColor: '#96DFD8',
                        hoverBackgroundColor: '#D55464',
                        hoverBorderColor: '#D55464',
                        data: nounCount
                    }
                ],
            };
            var graphTarget = $(".outCome"+level);

            var barGraph = new Chart(graphTarget, {
                type: 'horizontalBar',
                data: chartdata,
                options: {
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        function openTab(evt, tabType) {
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
