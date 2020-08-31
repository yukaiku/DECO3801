<?php

// start a brand new session
session_start();
session_destroy();
session_start();
// require the dbfunction.php file
require_once "includes/dbFunction.php";


$username  = $_POST['username']; // retrieve the id from login form
$password = $_POST['pwd']; // retrieve the password from login form

if (!mysqli_connect_errno()) { // connection to database is successful
    $sqlQueryStr =
        "SELECT * " .
        "FROM student A " .
        "WHERE A.username = '{$username}' AND " .
        "A.pwd = AES_ENCRYPT('{$password}','deco2800') ";

    $result = mysqli_query ($connection, $sqlQueryStr); // execute the SQL query
    $row = mysqli_fetch_array($result);

    if($row != ""){ //has record of student
        $status = $row['status'];
        if($status != 0 ){ //user needs to verify account
            header('Location: verifyAccount.php?id='.$row['id'].'&username='.$username.'&pwd='.$password); // redirect to the verification page.
        }else{
            $sqlQueryStr =
                "SELECT id, school, firstname, lastname, username, nickname, AES_DECRYPT(pwd,'deco2800') as password, grade, class, status " .
                "FROM student A " .
                "WHERE A.username = '{$username}' AND " .
                "A.status = 0 AND " .
                "A.password = AES_ENCRYPT('{$password}','deco2800') ";

            $result = mysqli_query ($connection, $sqlQueryStr); // execute the SQL query
            if ($row = mysqli_fetch_array($result)) { // fetch the record
                $_SESSION['user'] = $row; // put the record into the session
                if(isset($_POST['rememberMe']) && $_POST['rememberMe'] != ""){
                    setcookie("user", json_encode($row), time() + (86400 * 30), "/");
                }else{
                    setcookie("user", json_encode(""), time()-3600, "/");
                }
                mysqli_close($connection); // close database connection
                header('Location: index.php?welcomeMessage=Welcome '. $row['firstName']); // redirect to the homepage.
            } else {
                mysqli_close($connection); // close database connection
                header('Location: index.php?error=Invalid username or password'); // redirect to the login page.
            }
        }
    }else{ //does not have record of student will go try teacher login
        $sqlQueryStr =
            "SELECT * " .
            "FROM teacher A " .
            "WHERE A.username = '{$username}' AND " .
            "A.pwd = AES_ENCRYPT('{$password}','deco2800') ";

        $result = mysqli_query ($connection, $sqlQueryStr); // execute the SQL query
        $row = mysqli_fetch_array($result);

        if($row != ""){ //has record of teacher
            $status = $row['status'];
            if($status != 0 ){ //user needs to verify account
                header('Location: verifyAccount.php?id='.$row['id'].'&username='.$username.'&pwd='.$password); // redirect to the verification page.
            }else{
                $sqlQueryStr =
                    "SELECT id, school, firstname, lastname, username, nickname, AES_DECRYPT(pwd,'deco2800') as password, grade, class, status " .
                    "FROM student A " .
                    "WHERE A.username = '{$username}' AND " .
                    "A.status = 0 AND " .
                    "A.password = AES_ENCRYPT('{$password}','deco2800') ";

                $result = mysqli_query ($connection, $sqlQueryStr); // execute the SQL query
                if ($row = mysqli_fetch_array($result)) { // fetch the record
                    $_SESSION['user'] = $row; // put the record into the session
                    if(isset($_POST['rememberMe']) && $_POST['rememberMe'] != ""){
                        setcookie("user", json_encode($row), time() + (86400 * 30), "/");
                    }else{
                        setcookie("user", json_encode(""), time()-3600, "/");
                    }
                    mysqli_close($connection); // close database connection
                    header('Location: teacherMain.php?welcomeMessage=Welcome '. $row['firstName']); // redirect to the homepage.
                } else {
                    mysqli_close($connection); // close database connection
                    header('Location: index.php?error=Invalid username or password'); // redirect to the login page.
                }
            }
        }else{
            header('Location: index.php?error=Invalid username or password'); // redirect to the login page.
        }
    }



} else {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
