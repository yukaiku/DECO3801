<?php
	if (isset($_POST['game_id']) && isset($_POST['player_id']) 
			&& isset($_POST['current_level']) && isset($_POST['score'])
			&& isset($_POST['noun_percentage'])) {

		$game_id = $_POST['game_id'];
		$player_id = $_POST['player_id'];
		$current_level = $_POST['current_level'];
		$score = $_POST['score'];
		$noun_percentage = $_POST['noun_percentage'];

		$database = new MySQLDatabase();
	    $database->connect();

	    // sql query here to store data
	    $query = "SELECT * FROM who_lost_roger WHERE studentid={$player_id} AND level={$current_level}";
	    $result = $database->query($query);
	    if (!$result) {
	    	$database->disconnect();
	    	die("failure");
	    }

	    $row = mysqli_fetch_array($result);
	    if ($row) {
	    	$old_score = $row['score'];
	    	if ($old_score < $score) {
	    		$query = "UPDATE who_lost_roger SET score='$score', 'percentage='$noun_percentage'";
	    	} else {
	    		$query = "";
	    	}
	    } else {
	    	$query = "INSERT INTO who_lost_roger (studentid, score, level, percentage, status) VALUES ('$player_id', '$score', '$current_level', '$noun_percentage', '0')";
	    }

	    if ($query != "") {
	    	$result = $database->query($query);
		    if (!$result) {
		    	$database->disconnect();
		    	die("failure");
		    }
	    }

	    $database->disconnect();
		if ($result) { exit("success"); } else { die("fail"); }

	} else {
		die("no correct data formats received");
	}
?>
