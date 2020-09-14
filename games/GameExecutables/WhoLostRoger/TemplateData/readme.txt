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

	function isGameLogin() {
		$game_login = FALSE;
		if (isset($_SESSION["login-account"] 
				&& $GLOBALS["game_login"] != null) {
			$game_login = TRUE;
		} else {
			header("Location: " . $_SERVER["DOCUMENT_ROOT"] . "index.php" 
					. "?error=invalid_login");
		}
	}

	isGameLogin();
?>
