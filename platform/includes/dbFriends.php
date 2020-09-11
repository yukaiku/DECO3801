<?php
require_once 'dbFunction.php';

$table_friend = "friendship";
$dbFields_friend = ["user","friend", "relationship", "status"];
$pk_user = "user";
$pk_friend = "friend";

$table_student = "student";
$dbFields_student = ["id","school", "firstname", "lastname", "username", "nickname","profileImage", "pwd", "grade", "class", "status"];
$pk_student = "id";

$table_teacher = "teacher";
$dbFields_teacher = ["id","school", "firstname", "lastname", "username", "pwd","status"];
$pk_teacher = "id";

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
    $result_array = getFriendshipBySql("select * from {$GLOBALS['table_student']} where id in (select f.friend from {$GLOBALS['table_friend']} f where f.user = {$id} and f.relationship = 0)");
    return $result_array;
}

function getClassmates($id = 0, $grade = 0, $class = ''){
    $result_array = getFriendshipBySql("select * from {$GLOBALS['table_student']} where id in 
            (select f.friend from {$GLOBALS['table_friend']} f where f.user = {$id} and f.relationship = 0) 
            AND grade = {$grade} AND class = '{$class}'");
    return $result_array;
}

function getTeacher($id = 0) { //get all the rows where record id = current id
    $result_array = getFriendshipBySql("select * from {$GLOBALS['table_teacher']} where id in (select f.friend from {$GLOBALS['table_friend']} f where f.user = {$id} and f.relationship = 1)");
    return $result_array;
}

//select * from student where id in (select friend from friendship where user = 19 and relationship = 0)
?>

