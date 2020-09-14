<?php
require_once 'dbFunction.php';

$table_studentProgress = "student_progress";
$dbFields_studentProgress = ["id","game", "student", "percentage", "score", "level","rank", "status"];
$pk_studentProgress = "id";

function getStudentProgress($like = "") {
    $like = strlen($like) > 0 ? "LIKE '{$like}'" : "";
    $string = getStudentProgressBySql("SELECT {$GLOBALS['pk_studentProgress']} FROM {$GLOBALS['table_studentProgress']} WHERE  {$GLOBALS['pk_studentProgress']} {$like}");
    if (empty($string)) {
        return true;
    } else {
        return false;
    }
}

function getAllStudentProgress($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getStudentProgressBySql("SELECT * FROM {$GLOBALS['table_studentProgress']} WHERE status = 0 {$orderBy}");
}

function getAllStudentProgresss($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getStudentProgressBySql("SELECT * FROM {$GLOBALS['table_studentProgress']} {$orderBy}");
}

function getClassRecordsProgress($game = 1, $school = "") {
    $whereBySchool = strlen($school) > 0 ? " AND s.school = {$school}" : "";
    $result_array = getStudentProgressBySql("SELECT AVG(score) as 'averageScore', sum(score) as 'score', AVG(percentage) as 'percentage', grade, class FROM {$GLOBALS['table_studentProgress']} as sp , {$GLOBALS['table_student']} as s  WHERE sp.game={$game} and sp.student = s.id {$whereBySchool}  AND s.status = 0 group by s.grade, s.class ");
    return $result_array;
}

function getStudentRecordsProgress($game = 1, $school = "", $class = "", $grade = "") {
    $whereBySchool = strlen($class) > 0 ? " AND s.school = {$school}" : "";
    $whereByClass = strlen($class) > 0 ? " AND s.class = '{$class}' " : "";
    $whereByGrade = strlen($grade) > 0 ? " AND s.grade = {$grade} " : "";
    $result_array = getStudentProgressBySql("SELECT  s.username, s.firstname, s.lastname, sum(score) as 'score', AVG(percentage) as 'percentage', grade, class  FROM {$GLOBALS['table_studentProgress']} as sp , {$GLOBALS['table_student']} as s  WHERE sp.game={$game} and sp.student = s.id {$whereBySchool} {$whereByClass} {$whereByGrade} AND s.status = 0 group by sp.student order by score desc ");
    return $result_array;
}

function getByIdStudentProgress($id = 0) { //get all the rows where record id = current id
    $result_array = getStudentProgressBySql("SELECT * FROM {$GLOBALS['table_studentProgress']} WHERE {$GLOBALS['pk_studentProgress']}= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getByIdStudentProgresss($id = 0) { //get all the rows where record id = current id
    $result_array = getStudentProgressBySql("SELECT * FROM {$GLOBALS['table_studentProgress']} WHERE {$GLOBALS['pk_studentProgress']}= {$id} LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getStudentProgressBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

function setStudentProgressAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newRecord = array();
    foreach ($GLOBALS['dbFields_studentProgress'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matches posts name
            $newRecord[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newRecord;
}

function createStudentProgress($infoArr = array()) {
    foreach ($infoArr as $field => $value) {
            $updateStrArr[] = "'{$value}'";
            $updateStrArrField[] = "{$field}";
    }
    $updateStr = join(", ", array_values($updateStrArr));
    $updateStrField = join(", ", array_values($updateStrArrField));
    $sql = "INSERT INTO {$GLOBALS['table_studentProgress']} ";
    $sql .= "({$updateStrField}) VALUES ({$updateStr})";
    if (query($sql)) {

        return insert_id();
    } else {
        return false;
    }
}

function updateStudentProgress($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_studentProgress'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_studentProgress']} = '{$infoArr[$GLOBALS['pk_studentProgress']]}'";
        unset($infoArr[$GLOBALS['pk_studentProgress']]);
        $updateStrArr = array();
        foreach ($infoArr as $field => $value) {
            $updateStrArr[] = "{$field}='{$value}'";
        }
        $updateStr = join(", ", array_values($updateStrArr));

        $sql = "UPDATE {$GLOBALS['table_studentProgress']} ";
        $sql .= "SET {$updateStr} ";
        $sql .= "WHERE {$pkStr}";
        query($sql);
        if (affected_rows() > 0) {
            return true;
        }
    }
    return false;
}
?>
