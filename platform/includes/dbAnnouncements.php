<?php
require_once 'dbFunction.php';

$table_announcements = "announcements";
$dbFields_announcements = ["id", "title", "message", "timeStamp", "teacherId", "status"];
$pk_user = "id";

function getAnnouncementsBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

function setAnnouncementAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newRecord = array();
    foreach ($GLOBALS['dbFields_announcements'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matches posts name
            $newRecord[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newRecord;
}

function getAllAnnouncements($timeStamp = "", $status = ""){
    $whereTimeStamp = strlen($timeStamp) > 0 ? " and timeStamp = {$timeStamp} " : "";
    $whereStatus = strlen($status) > 0 ? " and status = {$status} " : "";
    $whereSql = " where timeStamp >= DATE_SUB(NOW(),INTERVAL 1 YEAR) and status = 0 ";
    $whereSql .= $whereTimeStamp . $whereStatus;
    $sql = "SELECT * FROM {$GLOBALS['table_announcements']} {$whereSql} orderBy timeStamp desc";
    return $sql;
}

?>

