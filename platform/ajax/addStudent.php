
<?php

require_once '../includes/dbStudent.php';

$getUsers = getAllStudents("id");

$newUser = setStudentAttributes($_POST);

foreach ($getUsers as $userDetails){
    $username = $_POST['username'];
    if($username == $userDetails['username']){
        echo 'Username has been used';
        die();
    }
}

$resultId = createStudent($newUser);

close_connection();

if ($resultId) {
    echo "Account has been created";
    die();
}



?>