<?php
		
	if(isset($_POST['username'])&&isset($_POST['password']))
	{
		if(!empty($_POST['username'])&&!empty($_POST['password'])){
			$user=htmlentities($_POST['username']);
			$pass=htmlentities($_POST['password']);
			if(isset($_POST['Login'])){
				require'db_connection.php';
				$query="SELECT * FROM `school_db` WHERE `school_user`='".$user."'";
				$run = mysqli_query($connection,$query);
				$rows = @mysqli_num_rows($run);
				if($rows){
					while ($finduser = mysqli_fetch_assoc($run)) {
						$username = $finduser['school_user'];
						$password = $finduser['school_pass'];
						if($password == $pass){
							header('Location:reg-form.php');
						}
					}
				}


			}
		}else{
			echo 'Enter your details';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quest Login</title>
	<link rel="stylesheet" type="text/css" href="reg-form.css">
</head>
<body>
<h1><center>Login For Registration</center></h1>
<div class="container">
	<form action="register.php" method="POST">
		<label><span>Username:</span><input type="text" name="username" placeholder="Enter the username"></label></br>
		<label><span>Password:</span><input type="password" name="password" placeholder="Enter your password"></label></br>
		<input type="submit" name="Login">
	</form>
</div>
</body>
</html>