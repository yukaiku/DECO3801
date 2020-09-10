(Important) Steps
1. WebGL build with player settings
2. Rename "index.html" with ".php" format
3. Append the following php codes into the file

/*=========================== Divider ===========================*/

(Optional) Customized Settings
Enter colour in the "Background" field
Enter "false" in the "Scale to fit" field to disable scaling
Enter "true" in the "Optimize for pixel art" field to use CSS more appropriate for pixel art

/*=========================== Divider ===========================*/

(PHP Codes) Appends

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
