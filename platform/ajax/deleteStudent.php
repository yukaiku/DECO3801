<?php
require_once '../includes/dbStudent.php';

$deleteArray = isset($_POST['deleteArray']) ? $_POST['deleteArray'] : "";
$deleteSql = "";
if($deleteArray != ""){
    foreach($deleteArray as $deleteRow => $deleteId){
        if(strlen($deleteSql) > 0){
            $deleteSql .= " or id = {$deleteId} ";
        }else{
            $deleteSql .= " Where id = {$deleteId} ";
        }
    }
    $sql = "UPDATE student SET status = 1 {$deleteSql}";
    if (!mysqli_connect_errno()) {
        $result = query ($sql); // execute the SQL query
        print_r("Record Updated");
        close_connection();
    }
}




