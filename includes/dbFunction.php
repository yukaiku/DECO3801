<?php

require_once 'config.php';

function open_connection() {
    global $connection;

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        die("Database connection failed: " .
                mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")");
    }
}

function close_connection() {
    global $connection;
    if (isset($connection)) {
        mysqli_close($connection);
        unset($connection);
    }
}

function query($sql) {
    global $connection;
    $result = mysqli_query($connection, $sql);
    return $result;
}

function fetch_array($result_set) {
    return mysqli_fetch_array($result_set);
}

function insert_id(){
    global $connection;
    // get the last id inserted over the current db connection
    return mysqli_insert_id($connection);
}

function escape_value($str){
    global $connection;
    $escaped_str = mysqli_escape_string($connection, $str);
    return $escaped_str;
}

function affected_rows() {
    global $connection;
    return mysqli_affected_rows($connection);
}

open_connection();

?>
