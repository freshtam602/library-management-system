<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
		<script type="text/javascript" src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
		<style type="text/css">
			body {
				margin: 0;
				font-family: 'Segoe UI', sans-serif;
					  
			}

			.navbar {
				  background-color: #a073fa;
			}
			
			.nav-link {
				color:white;
				text-decoration: none;
				font-weight: bold; 
				 color: white;
				 font-size: 18px;
			}

			.text-end {
				margin-left: auto;
			}

		
		
	</style>
	</head>
	<body>
		
			<nav class="navbar navbar-expand-sm  fixed-top">
				<div class="container">
								
					<div>
						<ul class="navbar-nav align-items-center">
							<li class="nav-item"><a href="user_dashboard.php" class="nav-link mylink">Home</a></li>
							<li class="nav-item"><a href="book.php" class="nav-link mylink">Books</a></li>
							<li class="nav-item"><a href="sales.php" class="nav-link mylink">Sales</a></li>
							<li class="nav-item"><a href="librarian.php" class="nav-link mylink">Librarians</a></li>
							<li class="nav-item"><a href="member.php" class="nav-link mylink">Members</a></li>
							
						</ul>
					</div>
					<a href="logout.php" class="nav-link text-end mylink">Logout</a>
				</div>	
		</nav>
		
	</body>
	</html>