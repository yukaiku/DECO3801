<?php
require_once 'dbFunction.php';

$table_student = "student";
$dbFields_student = ["id","school", "firstname", "lastname", "username", "nickname","profileImage", "pwd", "grade", "class","lastactivity", "status"];
$pk_student = "id";

function getStudent($like = "") {
    $like = strlen($like) > 0 ? "LIKE '{$like}'" : "";
    $string = getStudentBySql("SELECT {$GLOBALS['pk_student']} FROM {$GLOBALS['table_student']} WHERE  {$GLOBALS['pk_student']} {$like}");
    if (empty($string)) {
        return true;
    } else {
        return false;
    }
}

function getAllStudent($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getStudentBySql("SELECT * FROM {$GLOBALS['table_student']} WHERE status = 0 {$orderBy}");
}

function getAllStudents($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getStudentBySql("SELECT * FROM {$GLOBALS['table_student']} {$orderBy}");
}

function getByIdStudent($id = 0) { //get all the rows where record id = current id
    $result_array = getStudentBySql("SELECT *, aes_decrypt(pwd, 'deco3801') as password FROM {$GLOBALS['table_student']} WHERE {$GLOBALS['pk_student']}= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getByGradeClassStudent($grade, $class, $school) { //get all the rows by class
    $result_array = getStudentBySql("SELECT * FROM {$GLOBALS['table_student']} WHERE grade = '{$grade}' AND class = '{$class}' AND school = {$school} AND status = 0 order by username, firstname, lastname ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getByIdStudents($id = 0) { //get all the rows where record id = current id
    $result_array = getStudentBySql("SELECT * FROM {$GLOBALS['table_student']} WHERE {$GLOBALS['pk_student']}= {$id} LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getStudentBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

function setStudentAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newRecord = array();
    foreach ($GLOBALS['dbFields_student'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matches posts name
            $newRecord[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newRecord;
}

function createStudent($infoArr = array()) {
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
                $updateStrArr[] = "now()";
                $updateStrArrField[] = "lastactivity";
            }
        } else {
            $updateStrArr[] = "'{$value}'";
            $updateStrArrField[] = "{$field}";
        }
    }
    $updateStr = join(", ", array_values($updateStrArr));
    $updateStrField = join(", ", array_values($updateStrArrField));
    $sql = "INSERT INTO {$GLOBALS['table_student']} ";
    $sql .= "({$updateStrField}) VALUES ({$updateStr})";
    if (query($sql)) {

        return insert_id();
    } else {
        return false;
    }
}

function updateStudent($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_student'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_student']} = '{$infoArr[$GLOBALS['pk_student']]}'";
        unset($infoArr[$GLOBALS['pk_student']]);
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

        $sql = "UPDATE {$GLOBALS['table_student']} ";
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

