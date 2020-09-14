(Important) Steps
1. After WebGL build with player settings
2. Rename "index.html" with ".php" format
3. Append the following php codes into the file

/*=========================== Divider ===========================*/

(Optional) Customized Settings
Enter colour in the "Background" field

/*=========================== Divider ===========================*/

(PHP Codes) Appends --- not completed yet

<?php
	session_start();

	if (!isset($_SESSION['student'])) {
		$root_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://';
		$server_url = $root . $_SERVER['SERVER_NAME'] . '/';
		$location = $server_url . 'cats/platform/index.php';
		header('Location: $location');
	}

	$game_id = $_SESSION['game_id'];
	$player_id = $_SESSION['player_id'];
	$highest_level = $_SESSION['highest_level'];

	if (!isset($game_id) || !isset($player_id) || !isset($highest_level)) {
		$root_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://';
		$server_url = $root . $_SERVER['SERVER_NAME'] . '/';
		$location = $server_url . 'cats/platform/index.php';
		header('Location: $location');
	}

	// got this student progress here
	// going to send into the game
?>
