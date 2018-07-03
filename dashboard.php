<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashborad</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3" style="margin-top: 20px;">
				
			    <div class="jumbotron">
			        <h2>Welcome <?php echo $_SESSION["name"]; ?>!</h2> 
			        <p>Click to <a href="logout.php" class="btn btn-primary btn-lg" role="button" style="width:25%";>Logout</a></p>.
			    </div>
			</div>

		</div>

	    <div></div>
	</div>
</body>
</html>