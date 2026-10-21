<?php
	session_start();
	
		include("navbar.php");
		
	if(!isset($_SESSION['username']) && !isset($_COOKIE['user'])){
		header("Location:login.php");
		exit();
	}

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	

// اگر کاربر لاگین نکرده باشد → برگرد به login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
  
	<style type="text/css">
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: sans-serif;
    }

    .welcome-box {
      background: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      text-align: center;
      width: 350px;
      animation: fadeIn 1.2s ease-in-out;
    }

    h1 {
      color: #a073fa;;
      margin-bottom: 10px;
    }

    p {
      color: #374151;
      font-size: 16px;
    }

    a {
      display: inline-block;
      text-decoration: none;
      color: black;
      padding: 10px 20px;
      border-radius: 8px;
      transition: 0.3s;
    }

    

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <div class="welcome-box">
    <h1>🎉 خوش آمدی <?php echo htmlspecialchars($username); ?>!</h1>
    <p>ورودت موفقانه انجام شد 🌸</p>
    <a href="logout.php">خروج از سیستم</a>
  </div>
</body>
</html>
