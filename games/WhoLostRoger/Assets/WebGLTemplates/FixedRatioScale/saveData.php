<?php
	if (isset($_POST['game_id']) && isset($_POST['player_id']) 
			&& isset($_POST['current_level']) && isset($_POST['score_point'])) {

		$database = new MySQLDatabase();
	    $database->connect();

	    // sql query here to store data
	    $query = "";

	    $result = $database->query($query);
	    $database->disconnect();
		if ($result) { exit("success"); } else { die("fail"); }

	} else {
		die("fail");
	}
?>
