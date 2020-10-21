<?php
// start the session
session_start();

// destroy the session
session_destroy();

$errorMessage = "";
if(isset($_GET['error'])){
    $errorMessage = $_GET['error'];
}
$rememberMe = 1;
if(isset($_COOKIE["student"]) && $_COOKIE['student'] != "") {
    $user = json_decode($_COOKIE['student']);
    $username = $user->username;
    $password = $user->password;
}else if(isset($_COOKIE["teacher"]) && $_COOKIE['teacher'] != "") {
    $user = json_decode($_COOKIE['teacher']);
    $username = $user->username;
    $password = $user->password;

}else{
    $rememberMe = 0;
    $username = "";
    $password = "";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin</title>

    <?php
    include 'css.php';
    ?>
</head>

<body class="text-center" >
<form class="form-signin" action="loginHandler.php" method="post">
    <img class="mb-4" src="img/logo.png" alt="" width="300" height="200">
    <!--    <h1 class="h3 mb-3 font-weight-normal">CatsEG</h1>-->
    <label for="inputUsername" class="sr-only" name="username">Username</label>
    <input style="margin-bottom: 10px; background-color: #BCE8E3" type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" value = "<?= $username ?>" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input style="background-color: #BCE8E3" type="password" id="inputPassword" class="form-control" placeholder="Password" name="pwd" value = "<?= $password ?>" required>
    <div class="checkbox mb-3">
        <label>
            <?php
            if ($rememberMe == 1){
                echo '<input type="checkbox" name="rememberMe" value="remember-me" checked> Remember me';
            }else{
                echo '<input type="checkbox" name="rememberMe" value="remember-me"> Remember me';
            }
            ?>

        </label>
    </div>
    <button class="btn-all btn-lg btn-block" type="submit">SIGN IN</button>
</form>
<script type="text/javascript">
    <?php
    if($errorMessage != ""){
        echo "alert('{$errorMessage}');";
    }
    ?>
</script>
</body>
</html>

