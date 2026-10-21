<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db_name = "librarydb";
	
		
	$connect = new mysqli($servername, $username, $password, $db_name);
	
	$message = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$user = trim($_POST['username']);
		$email = trim($_POST['email']);
		$pass = trim($_POST['password']);
		
		if(empty($user) || empty($email) || empty($pass)){
			$message = "All fields are required!";
		}else{
			//چک کردن تکراری نبودن ایمیل و یوزرنیم 
			$check = "SELECT * FROM books WHERE username = '$user' OR email = '$email'";
			$result = $connect->query($check);
			
			if($result->num_rows > 0){
				$message = "Username Or Email already exist!";
			}else{
				//هش کردن پسورد
				$hashed = password_hash($pass, PASSWORD_DEFAULT);
				
				$sql = "INSERT INTO books(username, email, password, role) VALUES('$user', '$email', '$hashed', 'user')";
				
				if($connect->query($sql) === TRUE){
					$message = "Registration successfull.";
				}else{
					$message = "Error " . $connect->error;
				}
			}
		}
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
		<script type="text/javascript" src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
		
		<div class="container">
			<h1 class="text-center p-4 bg-info text-white">Register Form</h1>
			
			<div class="row p-3">
				<div class="col-sm-4"></div>
				<div class="col-sm-4 p-4" style="border: 1px solid lightgray">
					<p class="text-info">
						<?php echo $message; ?>
					</p>
					<form action="" method="post">
						<label for="">Username:</label>
						<input type="text" name="username" class="form-control" />
						<label for="">Email:</label>
						<input type="email" name="email" class="form-control" />
						<label for="">Password:</label>
						<input type="password" name="password" class="form-control" />
						<input type="submit" class="btn btn-success mt-3" />
					</form>
				</div>
				<div class="col-sm-4"></div>
			</div>
			
		</div>
		
	</body>
</html>
