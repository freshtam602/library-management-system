<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db_name = "librarydb";
	
	include("navbar.php");
	
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	$connect = mysqli_connect($servername, $username, $password, $db_name);
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		
		if(empty($_POST['Title'])){
			$Title = null;
		}else{
			$Title = $_POST['Title'];
		}
		if(empty($_POST['Author'])){
			$Author = null;
		}else{
			$Author= $_POST['Author'];
		}
		if(empty($_POST['year'])){
			$year = null;
		}else{
			$year = $_POST['year'];
		}
		if(empty($_POST['Genre'])){
			$Genre = null;
		}else{
			$Genre = $_POST['Genre'];
		}
			if(empty($_POST['PublishedYear'])){
			$PublishedYear= null;
		}else{
			$PublishedYear= $_POST['PublishedYear'];
		}
	
		
		if(isset($_POST['edit_id']) && !empty($_POST['edit_id'])){
			//Edit books Info
			$edit_id = (int)$_POST['edit_id'];
			$sql = "UPDATE books SET Title='$Title',  Author='$Author',  year='$year',  Genre='$Genre',  PublishedYear='$PublishedYear' WHERE BookID=$edit_id";
			if(!mysqli_query($connect, $sql)){
				die("Edit Error: " . mysqli_error($connect));
			}
		}else{
			//Insert new Books
			$sql = "INSERT INTO books (Title, Author, year, Genre, PublishedYear) VALUES('$Title','$Author','$year','$Genre', '$PublishedYear')";
			if(!mysqli_query($connect, $sql)){
				die("Insert Error: " . mysqli_error($connect));
			}
		}
		header("Location: book.php");
		exit;
		header("Location: book.php");
		exit;
	}
	
	
	
	//Delete Student
	if (isset($_GET['delete_id'])){
		$delete_id = (int)$_GET['delete_id'];
		$sql = "DELETE FROM books WHERE bookID=$delete_id";
		if(!mysqli_query($connect, $sql)){
			die("Delete Error: " . mysqli_error($connect));
		}
		header("Location: book.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
		<script type="text/javascript" src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
		<style type="text/css">
			.btn{
				background-color:#9152ff;
				color: white;
			}
		</style>
	</head>
	<body>
		
		<div class="container-fluid p-5 ">
	
			<div class="row">
				<div class="col-sm-12 mt-3 ">
					<form action="" method="POST">
						<input type="hidden" name="edit_id" id="edit_id" class=""/>
						<input type="text" name="Title" id="Title" placeholder="Title" class=" p-1"/>
						<input type="text" name="Author" id="Author" placeholder="Author" class=" p-1"/>
						<input type="numbar" name="year" id="year" placeholder="Year" class=" p-1"/>
						<input type="text" name="Genre" id="Genre" placeholder="Genre" class=" p-1"/>
						<input type="varchar" name="PublishedYear" id="PublishedYear" placeholder="PublishedYear" class=" p-1"/>
						<input type="submit" value="submit" class="btn" />
					</form>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12 mt-3">
					<table class="table mt-3 table-bordered">
						<tr>
							<th>ID</th>
							<th>Title</th>
							<th>Author</th>
							<th>year</th>
							<th>Genre</th>
							<th>PublishedYear</th>
						</tr>
						<?php 
							$sql = "SELECT * FROM books";
							$result = mysqli_query($connect, $sql);
							
							if(mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_assoc($result)){
						?>
							<tr>
								<td><?php echo $row['BookID']; ?></td>
								<td><?php echo $row['Title']; ?></td>
								<td><?php echo $row['Author']; ?></td>
								<td><?php echo $row['year']; ?></td>
								<td><?php echo $row['Genre']; ?></td>
								<td><?php echo $row['PublishedYear']; ?></td>
								
								<td>
									<a class="btn" href="book.php?delete_id=<?php echo $row['BookID']; ?>" onclick="return confirm('Sure?');">Delete</a>
									
									<button class="btn"onclick="editbooks('<?php echo $row['BookID']; ?>' , '<?php echo $row['Title']; ?>' ,
									'<?php echo $row['Author']; ?>' , '<?php echo $row['year']; ?>' , '<?php echo $row['Genre']; ?>','<?php echo $row['PublishedYear']; ?>')">Edit</button>
								</td>
							</tr>
						<?php
							}
						}else{
							echo "There is no records.";
						}
						?>
					</table>
					
					<script type="text/javascript">
						function editbooks(edit_id, Title, Author, year, Genre, PublishedYear){
							document.getElementById("edit_id").value = edit_id;
							document.getElementById("Title").value = Title;
							document.getElementById("Author").value = Author;
							document.getElementById("year").value = year;
							document.getElementById("Genre").value = Genre;
							document.getElementById("PublishedYear").value = PublishedYear;
						}
					</script>
					
					
				</div>
			</div>
		</div>
		
	</body>
</html>
