<?php
require_once 'dbFunction.php';

$table_announcements = "announcements";
$dbFields_announcements = ["id", "title", "message", "timeStamp", "teacherId", "status"];
$pk_announcement = "id";

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

function createAnnouncements($infoArr = array()) {
    foreach ($infoArr as $field => $value) {
        if ($value != "") {
            $updateStrArr[] = "'{$value}'";
            $updateStrArrField[] = "{$field}";
            if ($field === array_key_last($infoArr)){
                $updateStrArr[] = "now()";
                $updateStrArrField[] = "timeStamp";
            }

        }

    }
    $updateStr = join(", ", array_values($updateStrArr));
    $updateStrField = join(", ", array_values($updateStrArrField));
    $sql = "INSERT INTO {$GLOBALS['table_announcements']} ";
    $sql .= "({$updateStrField}) VALUES ({$updateStr})";
    if (query($sql)) {
        return insert_id();
    } else {
        return false;
    }
}

function updateAnnouncement($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_announcement'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_announcement']} = '{$infoArr[$GLOBALS['pk_announcement']]}'";
        unset($infoArr[$GLOBALS['pk_announcement']]);
        $updateStrArr = array();
        foreach ($infoArr as $field => $value) {
            if ($value != "") {
                    $updateStrArr[] = "{$field}='{$value}'";

            }
        }
        $updateStr = join(", ", array_values($updateStrArr));

        $sql = "UPDATE {$GLOBALS['table_announcements']} ";
        $sql .= "SET {$updateStr} ";
        $sql .= "WHERE {$pkStr}";
        query($sql);
        if (affected_rows() > 0) {
            return true;
        }
    }
    return false;
}

function getAllAnnouncements($timeStamp = "", $status = ""){
    $whereTimeStamp = strlen($timeStamp) > 0 ? " and timeStamp = {$timeStamp} " : "";
    $whereStatus = strlen($status) > 0 ? " and status = {$status} " : "";
    $whereSql = " where timeStamp >= DATE_SUB(NOW(),INTERVAL 1 YEAR) and status = 0 ";
    $whereSql .= $whereTimeStamp . $whereStatus;
    $sql = "SELECT * FROM {$GLOBALS['table_announcements']} {$whereSql}  order By timeStamp desc";
    return $sql;
}

function getAllAnnouncementWithTeacherName($timeStamp = "", $status = "", $limit = ""){
    $announcementSql = getAllAnnouncements($timeStamp, $status);
    $limitSql = " limit {$limit} ";
    $sql = " SELECT a.title, a.message, a.timeStamp, a.id, t.firstname, t.lastname ";
    $sql .= " from ({$announcementSql}) a, teacher t ";
    $sql .= " WHERE a.teacherid = t.id and a.status = 0 order by a.timeStamp desc ";
    $sql .= $limitSql;
    return $sql;
}

?>
