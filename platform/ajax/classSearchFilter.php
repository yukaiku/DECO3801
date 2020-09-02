<?php
require_once "../includes/dbStudent.php";
$searchItem = isset($_POST['search']) ? $_POST['search'] : "";
$whereSql = "Where status = 0 ";
if($searchItem == ""){
    echo "";
}
if($searchItem != ""){
    $whereSql .= " and (firstname LIKE '%". $searchItem . "%' OR lastname LIKE '%". $searchItem . "%' )";
}

$sql = "Select id, grade, class from student ". $whereSql . " group by grade, class order by grade, class desc";
$resultSet = query($sql);
$resultArray = array();
while ($row = fetch_array($resultSet)) {
    array_push($resultArray,array(
        "grade"=>$row['grade'],
        "class"=>$row['class']
    ));
}
$resultJSON = json_encode($resultArray);
print_r($resultJSON);