<?php
	session_start();

	$platform_path = 'cats/platform/index.php';

	// faked data for testing functionality
	$_SESSION['student'] = 1;
	$_SESSION['player_id'] = 1;
	$_SESSION['game_id'] = 1;
	$_SESSION['highest_level'] = 1;

	if (!isset($_SESSION['student'])) {
		$root_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://';
		$server_url = $root . $_SERVER['SERVER_NAME'] . '/';
		$location = $server_url . $platform_path;
		header('Location: $location');
	}

	$game_id = $_SESSION['game_id'];
	$player_id = $_SESSION['player_id'];
	$highest_level = $_SESSION['highest_level'];

	if (!isset($game_id) || !isset($player_id) || !isset($highest_level)) {
		$root_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://';
		$server_url = $root . $_SERVER['SERVER_NAME'] . '/';
		$location = $server_url . $platform_path;
		header('Location: $location');
	}

	// got this student progress here
	// going to send into the game
	include("index.html");
?>
