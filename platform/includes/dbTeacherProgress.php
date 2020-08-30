<?php

require_once 'dbFunction.php';

$table_teacherProgress = "teacher_progress";
$dbFields_teacherProgress = ["id", "game","teacher", "percentage", "score", "status"];
$pk_teacherProgress = "id";

function getAllTeacherProgress($orderBy = "") { //get all non deleted rows
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getTeacherProgressBySql("SELECT * FROM {$GLOBALS['table_teacherProgress']} WHERE status = 0 {$orderBy}");
}

function getAllTeacherProgresss($orderBy = "") { //get all rows
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getTeacherProgressBySql("SELECT * FROM {$GLOBALS['table_teacherProgress']} {$orderBy}");
}

function getByIdTeacherProgress($id = 0) { //get all the rows where record id = current id and not deleted
    $result_array = getTeacherProgressBySql("SELECT * FROM {$GLOBALS['table_teacherProgress']} WHERE id= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getByIdTeacherProgresss($id = 0) { //get all the rows where record id = current id
    $result_array = getTeacherProgressBySql("SELECT * FROM {$GLOBALS['table_teacherProgress']} WHERE id= {$id} LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getTeacherProgressBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

function setTeacherProgressAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newRecord = array();
    foreach ($GLOBALS['dbFields_teacherProgress'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matchs posts name
            $newRecord[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newRecord;
}

function createTeacherProgress($infoArr = array()) {
    foreach ($infoArr as $field => $value) {
        $updateStrArr[] = "'{$value}'";
        $updateStrArrField[] = "{$field}";
    }
    $updateStr = join(", ", array_values($updateStrArr));
    $updateStrField = join(", ", array_values($updateStrArrField));
    $sql = "INSERT INTO {$GLOBALS['table_teacherProgress']} ";
    $sql .= "({$updateStrField}) VALUES ({$updateStr})";
    if (query($sql)) {
        return insert_id();
    } else {
        return false;
    }
}

function updateTeacherProgress($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_teacherProgress'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_teacherProgress']} = '{$infoArr[$GLOBALS['pk_teacherProgress']]}'";
        unset($infoArr[$GLOBALS['pk_teacherProgress']]);
        $updateStrArr = array();
        foreach ($infoArr as $field => $value) {
            if ($value != "") {
                $updateStrArr[] = "{$field}='{$value}'";
            }
        }
        $updateStr = join(", ", array_values($updateStrArr));
        $sql = "UPDATE {$GLOBALS['table_teacherProgress']} ";
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

