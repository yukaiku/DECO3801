<?php
require_once 'dbFunction.php';

$table_friend = "friendship";
$dbFields_friend = ["user","friend"];
$pk_user = "user";
$pk_friend = "friend";

function getFriendshipBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

function getAllFriendship($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getStudentBySql("SELECT f1.* FROM {$GLOBALS['table_friend']} f1 inner join {$GLOBALS['table_friend']} f2 on f1.user = f2.friend and f1.friend = f2.user;");
}

function getByIdFriendship($id = 0) { //get all the rows where record id = current id
    $result_array = getFriendshipBySql("SELECT f1.* FROM {$GLOBALS['table_friend']} f1 
                    inner join {$GLOBALS['table_friend']} f2 on f1.user = f2.friend and f1.friend = f2.user 
                    WHERE f1.user = {$id}; ");
    return $result_array;
}

?>


