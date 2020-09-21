<?php
include('../includes/dbFriends.php');
session_start();
$status = "";
if (isset($_SESSION['student'])) { // basicinfo exist in session // from handle login
    $status = "student";
}


date_default_timezone_set("Australia/Brisbane");

$sql = "SELECT id, firstname, lastname, username FROM student ";
If ($status == "student"){
    $sql .= " WHERE id != '". $_SESSION["student"]["id"] ."' ";
    $sql .= " and id in (select f.friend from {$GLOBALS['table_friend']} f where f.user = {$_SESSION["student"]["id"]} and f.relationship = 0) or id in (select f.user from {$GLOBALS['table_friend']} f where f.friend = {$_SESSION["student"]["id"]} and f.relationship = 0) ";
}
$result = query($sql);
$returnArray = array();
foreach($result as $row)
{
    $status = '';
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 30 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity = fetchStudentLastActivity($row['id']);
    if($user_last_activity < $current_timestamp)
    {
        array_push($returnArray,$row);

    }
}

$resultJSON = json_encode($returnArray);
print_r($resultJSON);
