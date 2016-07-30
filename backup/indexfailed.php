<?php  
	require_once 'app/init.php';
	$itemQuery = $db->prepare("SELECT id, name, state FROM items WHERE user = :user");
	$itemQuery->execute(['user'=>$_SESSION['user_id']]);
	$items = $itemQuery->rowCount() ? $itemQuery : [];
	
 
	foreach ($items as $item) {
	    switch($item['state']) {
	        case 1:
	            $stateone[] = $item['name'];
	            break;
	        case 2:
	            $statetwo[] = $item['name'];
	            break;
	        case 3:
        	    $statethree[] = $item['name'];
        	    break;
    	}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Todo</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<div class="container_fluid">
		<div class="row">
			<h1 class="col-md-12 text-center">Todo</h1>
		</div>	
		<div class="row list_container">
			<div class="todo_column col-md-4">						
				<ul>
					<?php for($i = 0; $i < count($stateone); $i++): ?>
						<li>
							<span><?php echo $stateone[$i]; ?></span><br />	
							<button type="button" class="btn btn-danger">Delete</button>
							<button type="button" class="btn btn-warning"><a href="toWorking.php?to=working&itemId=<?php echo $stateone[$i][0] ?>">-></a></button>		
						</li>
					<?php endfor; ?>					
				</ul>
			</div>

			<div class="working_column col-md-4">
				<ul>
					<?php for($i = 0; $i < count($statetwo); $i++): ?>
							<li>
								<span><?php echo $statetwo[$i]; ?></span><br />	
								<button type="button" class="btn btn-warning"><-</button>		
								<button type="button" class="btn btn-danger">Delete</button>
								<button type="button" class="btn btn-warning">-></button>		
							</li>
					<?php endfor; ?>		
				</ul>
			</div>
			<div class="finished_column col-md-4">
				<ul>
					<?php for($i = 0; $i < count($statethree); $i++): ?>
						<li>
							<span><?php echo $statethree[$i]; ?></span><br />	
							<button type="button" class="btn btn-warning"><-</button>		
							<button type="button" class="btn btn-danger">Delete</button>
						</li>
					<?php endfor; ?>						
				</ul>
			</div>
		</div><!-- end of list_container-->

		
		<div class="row">
			<form action="add.php" method="post" class="col-md-12 item_add">
				<input type="text" name="name" placeholder="Write your task" class="input col-md-8 col-md-offset-2" required>
				<button type="submit" value="add" class="btn btn-success col-md-4 col-md-offset-4">Add Task</button>


			</form>
		</div>

	</div> <!-- end of container -->	
</body>
</html>