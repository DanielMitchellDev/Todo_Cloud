<?php
SESSION_START();
require_once 'app/init.php';

if(isset($_GET['id'])){
	$id = $_GET['id'];

	
		$toWorkingQuery = $db->prepare(
			"DELETE FROM items WHERE id = :item AND user = :user"
		);
		$toWorkingQuery->execute([
			'item'=> $id,
			'user'=> $_SESSION['userId']
		]);

	
}

header('Location: running.php');