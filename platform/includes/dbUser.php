<?php

require_once 'dbFunction.php';

$table_User = "user";
$dbFields_User = ["userId","username", "password", "phoneNumber", "profileImage", "userType","name", "status"];
$pk_User = "userId";

function getUser($like = "") {
    $like = strlen($like) > 0 ? "LIKE '{$like}'" : "";
    $string = getUserBySql("SELECT username FROM {$GLOBALS['table_User']} WHERE  username {$like}");
    if (empty($string)) {
        return true;
    } else {
        return false;
    }
}

function getAllUser($orderby = "") {
    $orderby = strlen($orderby) > 0 ? "ORDER BY {$orderby}" : "";
    return getUserBySql("SELECT * FROM {$GLOBALS['table_User']} WHERE status = 0 {$orderby}");
}

function getAllUsers($orderby = "") {
    $orderby = strlen($orderby) > 0 ? "ORDER BY {$orderby}" : "";
    return getUserBySql("SELECT * FROM {$GLOBALS['table_User']} {$orderby}");
}

function getByIdUser($id = 0) { //get all the rows where record id = current id
    $result_array = getUserBySql("SELECT * FROM {$GLOBALS['table_User']} WHERE userId= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getByIdUsers($id = 0) { //get all the rows where record id = current id
    $result_array = getUserBySql("SELECT * FROM {$GLOBALS['table_User']} WHERE userId= {$id} LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getUserBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

function setUserAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newUser = array();
    foreach ($GLOBALS['dbFields_User'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matchs posts name
            $newUser[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newUser;
}

function createUser($infoArr = array()) {
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
                $updateStrArrField[] = "userType";
            }
        } else {
            $updateStrArr[] = "'{$value}'";
            $updateStrArrField[] = "{$field}";
        }
    }
    $updateStr = join(", ", array_values($updateStrArr));
    $updateStrField = join(", ", array_values($updateStrArrField));
    $sql = "INSERT INTO {$GLOBALS['table_User']} ";
    $sql .= "({$updateStrField}) VALUES ({$updateStr})";
    if (query($sql)) {

        return insert_id();
    } else {
        return false;
    }
}

function updateUser($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_User'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_User']} = '{$infoArr[$GLOBALS['pk_User']]}'";

        unset($infoArr[$GLOBALS['pk_User']]);
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

        $sql = "UPDATE {$GLOBALS['table_User']} ";
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

