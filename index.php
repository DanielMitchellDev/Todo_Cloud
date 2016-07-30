<?php
session_start();
require_once("app/init.php");

if(!empty($_POST["username"]) && !empty($_POST["password"])){

	$username = strip_tags($_POST["username"]);
	$password = strip_tags($_POST["password"]);

	$loginQuery = $db->prepare("SELECT id, username, password FROM user WHERE username = :username");
	$loginQuery->execute([
		"username" => $username
	]);

	if($loginQuery){
			$login = $loginQuery->fetchAll(PDO::FETCH_ASSOC);
			
			if(!empty($login[0]['username'])){	
			$userId = $login[0]['id'];
			$dbUsername = $login[0]['username'];
			$dbPassword = $login[0]['password'];	 			 
			}

			if($username == $dbUsername && $password == $dbPassword){
				$_SESSION['username'] = $username;
				$_SESSION['userId'] = $userId;
				header('Location: running.php');
			}else{
				echo "You entered the wrong password, please try again!";
			}			

	}

}else{
	echo "Please fill in username AND password";
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Todo Cloud</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="row">
		<h1 class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center welcome">Welcome to Todo Cloud</h1>
		<h3 class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center instruction">Please Login to use the application</h3>

		<form action="index.php" method="post">
			<input class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 text-center login_username" type="text" placeholder="username" name="username">
			<input class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 text-center login_username" type="password" placeholder="password" name="password">
			<input class="col-xs-12 col-sm-4 col-sm-offset-4 col-md-2 col-md-offset-5 col-lg-2 col-lg-offset-5 text-center login_submit" type="submit" name="submit" value="Login!">
		</form>
	</div>
</body>
</html>