<?php
SESSION_START();
require_once 'app/init.php';

if(isset($_POST['name'])){
	$name = trim($_POST['name']);

	if(!empty($name)){
		$addedQuery = $db->prepare("INSERT INTO items (name, user, state, created) VALUES (:name, :user, 1, NOW())");
		$addedQuery->execute([
			'name' => $name,
			'user' => $_SESSION['userId']
		]);

	}
}

header('Location: running.php');