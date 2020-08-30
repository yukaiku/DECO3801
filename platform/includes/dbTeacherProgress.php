<?php

require_once 'dbFunction.php';

$table_teacherProgress = "teacher_progress";
$dbFields_teacherProgress = ["id", "game","teacher", "percentage", "score", "status"];
$pk_teacherProgress = "id";

function getAllteacherProgress($orderby = "") { //get all non deleted rows
    $orderby = strlen($orderby) > 0 ? "ORDER BY {$orderby}" : "";
    return getTeacherProgressBySql("SELECT * FROM {$GLOBALS['table_teacherProgress']} WHERE status = 0 {$orderby}");
}

function getAllteacherProgresss($orderby = "") { //get all rows
    $orderby = strlen($orderby) > 0 ? "ORDER BY {$orderby}" : "";
    return getTeacherProgressBySql("SELECT * FROM {$GLOBALS['table_teacherProgress']} {$orderby}");
}

function getByIdTeacherProgress($id = 0) { //get all the rows where record id = current id and not deleted
    $result_array = getTeacherProgressBySql("SELECT * FROM {$GLOBALS['table_teacherProgress']} WHERE id= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getByIdteacherProgresss($id = 0) { //get all the rows where record id = current id
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

function setteacherProgressAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newteacherProgress = array();
    foreach ($GLOBALS['dbFields_teacherProgress'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matchs posts name
            $newteacherProgress[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newteacherProgress;
}

function createteacherProgress($infoArr = array()) {
    foreach ($infoArr as $field => $value) {
        if ($value != "") {
            if ($field != 'password') {
                $updateStrArr[] = "'{$value}'";
                $updateStrArrField[] = "{$field}";
            } else {
                $updateStrArr[] = "AES_ENCRYPT('{$value}','infs3202')";
                $updateStrArrField[] = "{$field}";
                $updateStrArr[] = rand(100,999);
                $updateStrArrField[] = "status";
                $updateStrArr[] = "0";
                $updateStrArrField[] = "teacherProgressType";
            }
        } else {
            $updateStrArr[] = "'{$value}'";
            $updateStrArrField[] = "{$field}";
        }
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

function updateteacherProgress($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_teacherProgress'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_teacherProgress']} = '{$infoArr[$GLOBALS['pk_teacherProgress']]}'";

        unset($infoArr[$GLOBALS['pk_teacherProgress']]);
        $updateStrArr = array();
        foreach ($infoArr as $field => $value) {
            if ($value != "") {
                if ($field != 'password') {
                    $updateStrArr[] = "{$field}='{$value}'";
                } else {
                    $updateStrArr[] = "{$field}=AES_ENCRYPT('{$value}','infs3202')";
                }
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

