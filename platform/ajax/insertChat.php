<?php

//insertChat.php

include('../includes/dbFunction.php');

session_start();
if (isset($_SESSION['student'])) { // basicinfo exist in session // from handle login
    $user = $_SESSION['student']; // get basicinfo from session
    $status = "student";
}elseif(isset($_SESSION['teacher'])){
    $user = $_SESSION['teacher'];
    $status = "teacher";
}

$receiverId = $_POST['to_user_id'];
$message  = $_POST['chat_message'];
if($status = "student"){
    $sql = "INSERT INTO chat_message (userId, receiverId, message, timestamp, status)"
        . "VALUES ({$user['id']}, {$receiverId}, '{$message}', now(), 0)";
}
if(query($sql)) {
    echo fetch_user_chat_history($user['id'], $receiverId);
}

function fetch_user_chat_history($from_user_id, $to_user_id)
{
    $sql = "
 SELECT * FROM chat_message 
 WHERE (userId = '".$from_user_id."' 
 AND receiverId = '".$to_user_id."') 
 OR (receiverId = '".$from_user_id."' 
 AND userId = '".$to_user_id."') 
 ORDER BY timestamp asc
 ";
    $result = query($sql);
    $output = '<ul class="list-unstyled">';
    foreach($result as $row)
    {
        $user_name = '';
        if($row["userId"] == $from_user_id) {
            $user_name = '<b class="text-success">You</b>';
        } else {
            $user_name = '<b class="text-danger">'.get_user_name($row['userId']).'</b>';
        }
        $output .= '
          <li style="border-bottom:1px dotted #ccc">
           <p>'.$user_name.' - '.$row["message"].'
            <div align="right">
             - <small><em>'.$row['timestamp'].'</em></small>
            </div>
           </p>
          </li>
          ';
    }
    $output .= '</ul>';
    return $output;
}

function get_user_name($user_id)
{
    $sql = "SELECT username, nickname FROM student WHERE id = '$user_id' limit 1";
    $result = query($sql);
    foreach($result as $row)
    {
        if($row['nickname']){
            return $row['nickname'];
        }else{
            return $row['username'];
        }

    }
}

?>