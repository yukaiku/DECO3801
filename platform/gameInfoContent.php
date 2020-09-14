<?php

$gameInfo = getByIdGame($gameId);
$gameName = $gameInfo['name'];
$gameSubject = $gameInfo['subject'];
$gameDescription = $gameInfo['description'];
$gameGrade = $gameInfo['grade'];
$gameGenre = $gameInfo['genre'];

$wholostroger_url = '../games/GameExecutables/WhoLostRoger/index.php';

open_connection();
$player_id = $user['id'];
$game_id = $gameId;
$query = "select * from student_progress where id={$player_id} and game={$game_id}";
$result = mysqli_query($connection,$query);
$row = mysqli_fetch_array($result);
if ($row != ""){
    $highest_level = $row['level'];

}else{
    $highest_level = 1;
}


close_connection();

$_SESSION['player_id'] = $player_id;
$_SESSION['game_id'] = $game_id;
$_SESSION['highest_level'] = $highest_level;

?>

<div role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="row" id="gameName">
        <h1><?= $gameName;?></h1>
    </div>
    <div class="row" id="subject">
        <h3>Subject: <?= $gameSubject; ?></h3>
    </div>
    <div class="row" id="description">
        <h3>Description:</h3>
        <p>
            <?= $gameDescription;?>
        </p>
        <p id="genre">
            Genre: <?= $gameGenre;?>
        </p>
        <p id="grade">
            Grade: <?=$gameGrade;?>
        </p>

    </div>
    <?php
    if($status == "teacher"){
        echo '<a class="btn btn-primary mb-2" style="text-align: center" href="teacherStudentProgressByClass.php?gameId='.$gameId.'">Student\'s Progress</a>';
    }elseif($status == "student"){
        echo '<a class="btn btn-success mb-2" style="text-align: center" href="' . $wholostroger_url . '">Play</a><br/>';
        echo '<a class="btn btn-primary mb-2" style="text-align: center" href="studentLeaderboard.php?gameId='.$gameId.'">Leaderboard</a><br/>';
        echo '<a class="btn btn-primary mb-2" style="text-align: center" href="gameInfo.php?gameId='.$gameId.'">Achievements</a>';
    }
    ?>
</div>
