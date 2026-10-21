<?php
	session_start();
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db_name = "librarydb";
	
	$connect = new mysqli($servername, $username, $password, $db_name);
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$user = $_POST['username'];
		$pass = $_POST['password'];
		
		$sql = "SELECT * FROM users WHERE username = '$user'";
		$result = $connect->query($sql);
		
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			
			if(password_verify($pass, $row['password'])){
				$_SESSION['username'] = $user;
				$_SESSION['role'] = $row['role'];
				
				if(isset($_POST['remember'])){
					setcookie("user", $user, time()+(86400*7));
				}
				
				if($_SESSION['role'] == 'admin'){
					header("Location:admin_dashboard.php");
				}else{
					header("Location:user_dashboard.php");
					exit();
				}
				
			}else{
				$error = "Incorrect Password!";
			}
		}else{
			$error = "Username not found!";
		}

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: #f5f5f5;
      flex-direction: column;
    }

    .container {
      display: flex;
      width: 900px;
      background: white;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .left {
      flex: 1;
      background: url('img/c.jpg') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      flex-direction: column;
      padding: 30px;
    }

    .left h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .left p {
      font-size: 16px;
      text-align: center;
    }

    .right {
      flex: 1;
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .right h2 {
      font-size: 28px;
      margin-bottom: 20px;
      text-align: center;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    input {
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
    }

    .btn {
      background-color: #ff3b3b;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
    }

    .btn:hover {
      background-color: #e23333;
    }

    .apple-btn {
      background: black;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 12px;
      font-weight: 600;
      cursor: pointer;
      margin-bottom: 15px;
    }

    .bottom-text {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .bottom-text a {
      color: #ff3b3b;
      text-decoration: none;
      font-weight: 500;
    }
  </style>
</head>
<body>
 		<div class="container">
		 <div class="left">
      <h2>Hello Developer 👋</h2>
      <p>Sign in to get started on your journey</p>
    </div>
		<div class="right">
      <h2>Welcome Back 👋</h2>

			
			
			<div class="row p-3 ">
				<div class="col-sm-4"></div>
				<div class="col-sm-4 mt-3 p-4">
					
					<?php if(isset($error)) echo "<p class='text-danger'>$error</p>" ?>
					
				
					<form action="" method="post">
						<label for="">Username:</label>
						<input type="text" name="username" placeholder="Enter your username" class="form-control" />
						<label for="">Password:</label>
						<input type="password" name="password" placeholder="Enter your password" class="form-control" />
						<label for="">
							<input type="checkbox" name="remember" class="mt-3" />Remember me
						</label>
						<br />
						<input type="submit" class="btn btn-success mt-2" />
					</form>
				  
				  
					<p class="mt-4">It's your first time?</p>
					<a href="register.php">Click here to create an account first!</a>
					
				</div>
				<div class="col-sm-4"></div>
			</div>
			
		</div>
</body>
</html>
