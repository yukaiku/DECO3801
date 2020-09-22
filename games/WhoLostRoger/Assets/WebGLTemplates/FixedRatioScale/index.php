<?php
	session_start();
	require("connectDB.php");

	$platform_path = 'platform/index.php';

	// faked data for testing functionality
	$_SESSION['student'] = 1;
	$_SESSION['player_id'] = 1;
	$_SESSION['game_id'] = 1;
	$_SESSION['highest_level'] = 1;

	if (!isset($_SESSION['student'])) {
		$root_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://';
		$server_url = $root_url . $_SERVER['SERVER_NAME'] . '/';
		$location = $server_url . $platform_path;
		header('Location: ' . $location);
	}

	$game_id = $_SESSION['game_id'];
	$player_id = $_SESSION['player_id'];
	$highest_level = 1;

	$database = new MySQLDatabase();
	$database->connect();
	$query = "SELECT * FROM who_lost_roger WHERE studentid='$player_id' ORDER BY level DESC LIMIT 1";
	$result = $database->query($query);
	if (!$result) {
		$database->disconnect();
		die("sql statement query fail");
	}

	$row = mysqli_fetch_array($result);
	if ($row != NULL){
		$highest_level = $row['level'];
	}
	$database->disconnect();

	if (!isset($game_id) || !isset($player_id) || !isset($highest_level)) {
		$root_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://';
		$server_url = $root_url . $_SERVER['SERVER_NAME'] . '/';
		$location = $server_url . $platform_path;
		header('Location: ' . $location);
	}

	// got this student progress here
	// going to send into the game
	include("index.html");
?>
