<?php
	session_start();

	if (isset($_SESSION['student']) && isset($_POST['getStudentProgress'])) {
		if (($_POST['getStudentProgress'] == 'yes') && isset($_SESSION['highest_level'])) {
			echo "game_id:" . $_SESSION['game_id'] . "|" . "player_id:" . $_SESSION['player_id'] . "|" . "highest_level:" . $_SESSION['highest_level'];

			unset($_SESSION['highest_level']);
			exit("");
		}
	}

	die("some errors happen");
?>
