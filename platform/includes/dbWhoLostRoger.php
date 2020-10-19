<?php

require_once 'dbStudent.php';

$table_whoLostRoger = "who_lost_roger";
$dbFields_whoLostRoger = ["recordid", "studentid","score", "level", "percentage", "timeUsed", "nounsClicked", "dateTime", "status"];
$pk_whoLostRoger = "id";

function getAllRoger($orderBy = "") { //get all non deleted rows
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getRogerBySql("SELECT * FROM {$GLOBALS['table_whoLostRoger']} WHERE status = 0 {$orderBy}");
}

function getAllRogers($orderBy = "") { //get all rows
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getRogerBySql("SELECT * FROM {$GLOBALS['table_whoLostRoger']} {$orderBy}");
}

function getByRogerId($id = 0) { //get all the rows where record id = current id and not deleted
    $result_array = getRogerBySql("SELECT * FROM {$GLOBALS['table_whoLostRoger']} WHERE id= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getByRogerIds($id = 0) { //get all the rows where record id = current id
    $result_array = getRogerBySql("SELECT * FROM {$GLOBALS['table_whoLostRoger']} WHERE id= {$id} LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getRogerBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

function setRogerAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newRecord = array();
    foreach ($GLOBALS['dbFields_whoLostRoger'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matchs posts name
            $newRecord[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newRecord;
}

function createRoger($infoArr = array()) {
    foreach ($infoArr as $field => $value) {
        $updateStrArr[] = "'{$value}'";
        $updateStrArrField[] = "{$field}";
    }
    $updateStr = join(", ", array_values($updateStrArr));
    $updateStrField = join(", ", array_values($updateStrArrField));
    $sql = "INSERT INTO {$GLOBALS['table_whoLostRoger']} ";
    $sql .= "({$updateStrField}) VALUES ({$updateStr})";
    if (query($sql)) {
        return insert_id();
    } else {
        return false;
    }
}

function updateRoger($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_whoLostRoger'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_whoLostRoger']} = '{$infoArr[$GLOBALS['pk_whoLostRoger']]}'";
        unset($infoArr[$GLOBALS['pk_whoLostRoger']]);
        $updateStrArr = array();
        foreach ($infoArr as $field => $value) {
            if ($value != "") {
                $updateStrArr[] = "{$field}='{$value}'";
            }
        }
        $updateStr = join(", ", array_values($updateStrArr));
        $sql = "UPDATE {$GLOBALS['table_whoLostRoger']} ";
        $sql .= "SET {$updateStr} ";
        $sql .= "WHERE {$pkStr}";
        query($sql);
        if (affected_rows() > 0) {
            return true;
        }
    }
    return false;
}

function splitNouns($infoArr = array()){
    return explode("|",$infoArr);
}

function getProgressByClass($school = "") {
    $whereBySchool = strlen($school) > 0 ? " AND s.school = {$school}" : "";
    $result_array = getRogerBySql("SELECT AVG(score) as 'averageScore', grade, class FROM {$GLOBALS['table_whoLostRoger']} as sp , {$GLOBALS['table_student']} as s  WHERE sp.studentid = s.id {$whereBySchool}  AND s.status = 0 group by s.grade, s.class ");
    return $result_array;
}

function getHighScoreOfEachPlayer(){ //Get hiscore of each player per level
    $sql = "SELECT studentid, MAX(score) AS hiscore, level, nounsClicked, dateTime FROM who_lost_roger GROUP BY studentid, level ORDER BY hiscore DESC";
    return $sql;
}

function getLeaderboard(){
    $highScoreOfEachPlayerSql = getHighScoreOfEachPlayer();
    $sql = "select sp.studentid, sum(sp.hiscore) as hiscore, s.username, s.firstname, s.lastname from ({$highScoreOfEachPlayerSql}) sp, student s where s.id = sp.studentid group by sp.studentid order by hiscore desc";
    $result_array = getRogerBySql($sql);
    return $result_array;
}

function getHighScoreOfEachStudentByClassAndGrade($school = "", $class = "", $grade = "", $orderBy = "", $orderByType = "") {
    $whereBySchool = strlen($class) > 0 ? " AND s.school = {$school}" : "";
    $whereByClass = strlen($class) > 0 ? " AND s.class = '{$class}' " : "";
    $whereByGrade = strlen($grade) > 0 ? " AND s.grade = {$grade} " : "";
    $orderBySql = " order by hiscore desc ";
    if($orderBy != "" and $orderByType != "" ){
        $orderBySql = "order by ". $orderBy . " " . $orderByType . " ";
    }
    $whereSql = "Where sp.studentid = s.id ";
    if($whereBySchool != ""|| $whereByGrade != "" || $whereByClass != ""){
        $whereSql .= " " . $whereByGrade . $whereByClass . $whereBySchool;
    }
    $highScoreOfEachPlayerSql = getHighScoreOfEachPlayer();
    $sql = "select sp.studentid, sum(sp.hiscore) as 'sumScore', max(sp.level) as 'maxLevel', s.username, s.firstname, s.lastname from ({$highScoreOfEachPlayerSql}) as sp, student s {$whereSql} group by sp.studentid {$orderBySql}";
    $result_array = getRogerBySql($sql);
    return $result_array;
}

function playCount($school = "", $class = "", $grade = "", $maxLevel = "", $lowestLevel = "") {
    $whereBySchool = strlen($class) > 0 ? "  s.school = {$school}" : "";
    $whereByClass = strlen($class) > 0 ? "  s.class = '{$class}' " : "";
    $whereByGrade = strlen($grade) > 0 ? "  s.grade = {$grade} " : "";
    $whereMaxLevel = strlen($maxLevel) > 0 ? " AND sp.level <= {$maxLevel} " : "";
    $whereLowestLevel = strlen($lowestLevel) > 0 ? " AND sp.level >= {$lowestLevel} " : "";
    $whereSql = "";
    if($whereBySchool != "" && $whereByGrade != "" && $whereByClass != ""){
        $whereSql .= " WHERE " . $whereByGrade . " AND " .  $whereByClass . " AND " . $whereBySchool . " ";
    }
    $sql = "select MONTHNAME(sp.dateTime) as month, count(*) as playCount
                from who_lost_roger sp
                where sp.dateTime >= DATE_SUB(NOW(),INTERVAL 1 YEAR) AND
                studentid in (select id from student s {$whereSql} ) 
                {$whereLowestLevel} {$whereMaxLevel} 
                group by MONTH(dateTime) ";
    $result_array = getRogerBySql($sql);
    return $result_array;
}

function getLearningOutComes($school = "", $class = "", $grade = "", $maxLevel = "", $lowestLevel = ""){
    $whereBySchool = strlen($class) > 0 ? "  s.school = {$school}" : "";
    $whereByClass = strlen($class) > 0 ? "  s.class = '{$class}' " : "";
    $whereByGrade = strlen($grade) > 0 ? "  s.grade = {$grade} " : "";
    $whereMaxLevel = strlen($maxLevel) > 0 ? " AND sp.level <= {$maxLevel} " : "";
    $whereLowestLevel = strlen($lowestLevel) > 0 ? " AND sp.level >= {$lowestLevel} " : "";
    $whereSql = "";
    if($whereBySchool != "" && $whereByGrade != "" && $whereByClass != ""){
        $whereSql .= " WHERE " . $whereByGrade . " AND " .  $whereByClass . " AND " . $whereBySchool . " ";
    }
    $highScoreOfEachPlayerSql = getHighScoreOfEachPlayer();
    $sql = "SELECT nounsClicked, level from ({$highScoreOfEachPlayerSql}) sp where sp.dateTime >= DATE_SUB(NOW(),INTERVAL 1 YEAR) AND studentid in (select id from student s {$whereSql} ) {$whereLowestLevel} {$whereMaxLevel} order by level asc";
    $result_array = getRogerBySql($sql);
    return $result_array;

}

