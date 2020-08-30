<?php
require_once 'dbFunction.php';

$table_school = "school";
$dbFields_school = ["id","name", "status"];
$pk_school = "id";

function getSchool($like = "") {
    $like = strlen($like) > 0 ? "LIKE '{$like}'" : "";
    $string = getSchoolBySql("SELECT {$GLOBALS['pk_school']} FROM {$GLOBALS['table_school']} WHERE  {$GLOBALS['pk_school']} {$like}");
    if (empty($string)) {
        return true;
    } else {
        return false;
    }
}

function getAllSchool($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getSchoolBySql("SELECT * FROM {$GLOBALS['table_school']} WHERE status = 0 {$orderBy}");
}

function getAllSchools($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getSchoolBySql("SELECT * FROM {$GLOBALS['table_school']} {$orderBy}");
}

function getByIdSchool($id = 0) { //get all the rows where record id = current id
    $result_array = getSchoolBySql("SELECT * FROM {$GLOBALS['table_school']} WHERE {$GLOBALS['pk_school']}= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getByIdSchools($id = 0) { //get all the rows where record id = current id
    $result_array = getSchoolBySql("SELECT * FROM {$GLOBALS['table_school']} WHERE {$GLOBALS['pk_school']}= {$id} LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getSchoolBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

function setSchoolAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newRecord = array();
    foreach ($GLOBALS['dbFields_school'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matches posts name
            $newRecord[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newRecord;
}

function createSchool($infoArr = array()) {
    foreach ($infoArr as $field => $value) {
        $updateStrArr[] = "'{$value}'";
        $updateStrArrField[] = "{$field}";
    }
    $updateStr = join(", ", array_values($updateStrArr));
    $updateStrField = join(", ", array_values($updateStrArrField));
    $sql = "INSERT INTO {$GLOBALS['table_school']} ";
    $sql .= "({$updateStrField}) VALUES ({$updateStr})";
    if (query($sql)) {

        return insert_id();
    } else {
        return false;
    }
}

function updateSchool($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_school'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_school']} = '{$infoArr[$GLOBALS['pk_school']]}'";
        unset($infoArr[$GLOBALS['pk_school']]);
        $updateStrArr = array();
        foreach ($infoArr as $field => $value) {
                    $updateStrArr[] = "{$field}='{$value}'";
        }
        $updateStr = join(", ", array_values($updateStrArr));

        $sql = "UPDATE {$GLOBALS['table_school']} ";
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

