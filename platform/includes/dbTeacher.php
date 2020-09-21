<?php
require_once 'dbFunction.php';

$table_teacher = "teacher";
$dbFields_teacher = ["id","school", "firstname", "lastname", "username", "pwd","status"];
$pk_teacher = "id";

function getTeacher($like = "") {
    $like = strlen($like) > 0 ? "LIKE '{$like}'" : "";
    $string = getTeacherBySql("SELECT {$GLOBALS['pk_teacher']} FROM {$GLOBALS['table_teacher']} WHERE  {$GLOBALS['pk_teacher']} {$like}");
    if (empty($string)) {
        return true;
    } else {
        return false;
    }
}

function getAllTeacher($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getTeacherBySql("SELECT * FROM {$GLOBALS['table_teacher']} WHERE status = 0 {$orderBy}");
}

function getAllTeachers($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getTeacherBySql("SELECT * FROM {$GLOBALS['table_teacher']} {$orderBy}");
}

function getBySchoolTeacher($school = 0) { //get all the rows where record id = current id
    return getTeacherBySql("SELECT *, aes_decrypt(pwd, 'deco3801') as password FROM {$GLOBALS['table_teacher']} WHERE school = {$school} AND status = 0 ");
}

function getByIdTeacher($id = 0) { //get all the rows where record id = current id
    $result_array = getTeacherBySql("SELECT *, aes_decrypt(pwd, 'deco3801') as password FROM {$GLOBALS['table_teacher']} WHERE {$GLOBALS['pk_teacher']}= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getByIdTeachers($id = 0) { //get all the rows where record id = current id
    $result_array = getTeacherBySql("SELECT * FROM {$GLOBALS['table_teacher']} WHERE {$GLOBALS['pk_teacher']}= {$id} LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getTeacherBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

function setTeacherAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newRecord = array();
    foreach ($GLOBALS['dbFields_teacher'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matches posts name
            $newRecord[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newRecord;
}

function createTeacher($infoArr = array()) {
    foreach ($infoArr as $field => $value) {
        if ($value != "") {
            if ($field != 'pwd') {
                $updateStrArr[] = "'{$value}'";
                $updateStrArrField[] = "{$field}";
            } else {
                $updateStrArr[] = "AES_ENCRYPT('{$value}','deco3801')";
                $updateStrArrField[] = "{$field}";
                $updateStrArr[] = "0";
                $updateStrArrField[] = "status";
            }
        } else {
            $updateStrArr[] = "'{$value}'";
            $updateStrArrField[] = "{$field}";
        }
    }
    $updateStr = join(", ", array_values($updateStrArr));
    $updateStrField = join(", ", array_values($updateStrArrField));
    $sql = "INSERT INTO {$GLOBALS['table_teacher']} ";
    $sql .= "({$updateStrField}) VALUES ({$updateStr})";
    if (query($sql)) {

        return insert_id();
    } else {
        return false;
    }
}

function updateTeacher($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_teacher'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_teacher']} = '{$infoArr[$GLOBALS['pk_teacher']]}'";
        unset($infoArr[$GLOBALS['pk_teacher']]);
        $updateStrArr = array();
        foreach ($infoArr as $field => $value) {
            if ($value != "") {
                if ($field != 'pwd') {
                    $updateStrArr[] = "{$field}='{$value}'";
                } else {
                    $updateStrArr[] = "{$field}=AES_ENCRYPT('{$value}','deco3801')";
                }
            }
        }
        $updateStr = join(", ", array_values($updateStrArr));

        $sql = "UPDATE {$GLOBALS['table_teacher']} ";
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

