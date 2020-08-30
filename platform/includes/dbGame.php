<?php
require_once 'dbFunction.php';

$table_game = "game";
$dbFields_game = ["id","name", "status"];
$pk_game = "id";

function getGame($like = "") {
    $like = strlen($like) > 0 ? "LIKE '{$like}'" : "";
    $string = getGameBySql("SELECT {$GLOBALS['pk_game']} FROM {$GLOBALS['table_game']} WHERE  {$GLOBALS['pk_game']} {$like}");
    if (empty($string)) {
        return true;
    } else {
        return false;
    }
}

function getAllGame($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getGameBySql("SELECT * FROM {$GLOBALS['table_game']} WHERE status = 0 {$orderBy}");
}

function getAllGames($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getGameBySql("SELECT * FROM {$GLOBALS['table_game']} {$orderBy}");
}

function getByIdGame($id = 0) { //get all the rows where record id = current id
    $result_array = getGameBySql("SELECT * FROM {$GLOBALS['table_game']} WHERE {$GLOBALS['pk_game']}= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getByIdGames($id = 0) { //get all the rows where record id = current id
    $result_array = getGameBySql("SELECT * FROM {$GLOBALS['table_game']} WHERE {$GLOBALS['pk_game']}= {$id} LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

function getGameBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

function setGameAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newRecord = array();
    foreach ($GLOBALS['dbFields_game'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matches posts name
            $newRecord[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newRecord;
}

function createGame($infoArr = array()) {
    foreach ($infoArr as $field => $value) {
                $updateStrArr[] = "'{$value}'";
                $updateStrArrField[] = "{$field}";
    }
    $updateStr = join(", ", array_values($updateStrArr));
    $updateStrField = join(", ", array_values($updateStrArrField));
    $sql = "INSERT INTO {$GLOBALS['table_game']} ";
    $sql .= "({$updateStrField}) VALUES ({$updateStr})";
    if (query($sql)) {

        return insert_id();
    } else {
        return false;
    }
}

function updateGame($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_game'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_game']} = '{$infoArr[$GLOBALS['pk_game']]}'";
        unset($infoArr[$GLOBALS['pk_game']]);
        $updateStrArr = array();
        foreach ($infoArr as $field => $value) {
                    $updateStrArr[] = "{$field}='{$value}'";
        }
        $updateStr = join(", ", array_values($updateStrArr));

        $sql = "UPDATE {$GLOBALS['table_game']} ";
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

