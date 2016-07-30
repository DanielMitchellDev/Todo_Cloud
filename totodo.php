<?php
SESSION_START();
require_once 'app/init.php';

if(isset($_GET['to'], $_GET['id'])){
	$as = $_GET['to'];
	$id = $_GET['id'];

	
		$toWorkingQuery = $db->prepare(
			"UPDATE items SET state = 1 WHERE id = :item AND user = :user"
		);
		$toWorkingQuery->execute([
			'item'=> $id,
			'user'=> $_SESSION['userId']
		]);

	
}

header('Location: running.php');
