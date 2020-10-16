<?php
// start the session
session_start();

// destroy the session
session_destroy();

$errorMessage = "";
if(isset($_GET['error'])){
    $errorMessage = $_GET['error'];
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

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="loginHandler.php" method="post">
    <img class="mb-4" src="img/logo.png" alt="" width="300" height="200">
    <!--    <h1 class="h3 mb-3 font-weight-normal">CatsEG</h1>-->
    <label for="inputUsername" class="sr-only" name="username">Username</label>
    <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pwd" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
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

