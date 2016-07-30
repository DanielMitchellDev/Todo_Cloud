<?php  
	session_start();
	require_once 'app/init.php';
	
	$query = "SELECT id, name, state FROM items WHERE user = :user";
	$itemQuery = $db->prepare($query);
	$itemQuery->execute(['user'=>$_SESSION['userId']]);
	$items = $itemQuery->fetchAll(PDO::FETCH_ASSOC);	 


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
	<div class="container-fluid">
	

		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#">Todo Cloud</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#"><?php echo $_SESSION['username']; ?></a></li>
		        <li><a class="btn logout_botton" href="logout.php" role="button">Logout</a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>


		<div class="row list_row">
			
			<div class="panel panel-warning col-md-4 col-sm-4 col-xs-12">
  				<div class="panel-heading">
    				<h3 class="panel-title text-center">Todo</h3>
  				</div>
 				<div class="panel-body">
					<ul class="panel_ul">
						<?php foreach($items as $item): ?>
							<?php if($item['state'] == 1): ?>
								<li class="panel_li">
									<span><?php echo $item['name']; ?></span><br />	
									<a href="delete.php?id=<?php echo $item['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
									<a href="toworking.php?to=2&id=<?php echo $item['id']; ?>"><button type="button" class="btn btn-warning">-></button></a>		
								</li>
							<?php endif; ?>
						<?php endforeach; ?>					
					</ul>
  				</div>
			</div>
		
			<div class="panel panel-success col-md-4 col-sm-4 col-xs-12">
  				<div class="panel-heading">
    				<h3 class="panel-title text-center">Working</h3>
  				</div>
 				<div class="panel-body">
 					<ul class="panel_ul">
						<?php foreach($items as $item): ?>
							<?php if($item['state'] == 2): ?>
								<li class="panel_li">
									<span><?php echo $item['name']; ?></span><br />	
									<a href="totodo.php?to=1&id=<?php echo $item['id']; ?>"><button type="button" class="btn btn-warning"><-</button></a>										
									<a href="delete.php?id=<?php echo $item['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
									<a href="todone.php?to=3&id=<?php echo $item['id']; ?>"><button type="button" class="btn btn-warning">-></button></a>		
								</li>
							<?php endif; ?>
						<?php endforeach; ?>	
					</ul>
  				</div>
			</div>

			<div class="panel panel-info col-md-4 col-sm-4 col-xs-12">
  				<div class="panel-heading">
    				<h3 class="panel-title text-center">Finished</h3>
  				</div>
 				<div class="panel-body">
					<ul class="panel_ul">
						<?php foreach($items as $item): ?>
							<?php if($item['state'] == 3): ?>
								<li class="panel_li">
									<span><?php echo $item['name']; ?></span><br />	
									<a href="toworking.php?to=2&id=<?php echo $item['id']; ?>"><button type="button" class="btn btn-warning"><-</button></a>												
									<a href="delete.php?id=<?php echo $item['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>						
					</ul>
  				</div>
			</div>
		</div>
			
		<div class="row">
			<form action="add.php" method="post" class="col-md-12 item_add">
				<input type="text" name="name" placeholder="Write your task" class="input col-md-10 col-sm-12 col-xs-12" required autocomplete="off">
				<button type="submit" value="add" class="btn btn-success col-md-2 col-sm-12 col-xs-12 add_button">Add Task</button>
			</form>
		</div>

		
	</div><!-- end of container-fluid -->
</body>
</html>