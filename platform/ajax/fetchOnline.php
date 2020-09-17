<?php

//fetchOnline.php
session_start();
if (isset($_SESSION['student'])) { // basicinfo exist in session // from handle login
    $user = $_SESSION['student']; // get basicinfo from session
    $status = "student";
}else{
    $status = "teacher";
}
include('../includes/dbStudent.php');

date_default_timezone_set("Australia/Brisbane");


If ($status == "student"){
    $sql = "
SELECT * FROM student 
WHERE id != '".$_SESSION["student"]["id"]."' 
";
}else{
    $sql = "SELECT * FROM student ";
}
$result = $query($sql);

$returnArray = [];
foreach($result as $row)
{
    $status = '';
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity = fetch_user_last_activity($row['id']);
    if($user_last_activity > $current_timestamp)
    {
        array_push($returnArray,$row);
    }
}


function fetchUserLastActivity($id)
{
    $sql = "
 SELECT * FROM student 
 WHERE id = '$id' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
    $result = query($sql);
    foreach($result as $row)
    {
        return $row['last_activity'];
    }
}

echo $returnArray;


?>