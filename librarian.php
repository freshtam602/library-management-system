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
		
		
		if(empty($_POST['Name'])){
			$Name = null;
		}else{
			$Name = $_POST['Name'];
		}
		if(empty($_POST['HireDate'])){
			$HireDate = null;
		}else{
			$HireDate= $_POST['HireDate'];
		}
		if(empty($_POST['Email'])){
			$Email = null;
		}else{
			$Email = $_POST['Email'];
		}
		if(empty($_POST['Phon'])){
			$Phon = null;
		}else{
			$Phon = $_POST['Phon'];
		}
			if(empty($_POST['Address'])){
			$Address= null;
		}else{
			$Address= $_POST['Address'];
		}
	
		
		if(isset($_POST['edit_id']) && !empty($_POST['edit_id'])){
			//Edit librarina Info
			$edit_id = (int)$_POST['edit_id'];
			$sql = "UPDATE librarians SET Name='$Name',  HireDate='$HireDate',  Email='$Email',  Phon='$Phon,  Address='$Address' WHERE LibrarianID=$edit_id";
			if(!mysqli_query($connect, $sql)){
				die("Edit Error: " . mysqli_error($connect));
			}
		}else{
			//Insert new librarina
			$sql = "INSERT INTO LibrarianID (Name, HireDate, Email, Phon, Address) VALUES('$Name','$HireDate','$Email','$Phon', '$Address')";
			if(!mysqli_query($connect, $sql)){
				die("Insert Error: " . mysqli_error($connect));
			}
		}
		header("Location: librarina.php");
		exit;
		header("Location: librarina.php");
		exit;
	}
	
	
	
	//Delete librarina
	if (isset($_GET['delete_id'])){
		$delete_id = (int)$_GET['delete_id'];
		$sql = "DELETE FROM librarians WHERE LibrarianID=$delete_id";
		if(!mysqli_query($connect, $sql)){
			die("Delete Error: " . mysqli_error($connect));
		}
		header("Location: librarina.php");
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
		
		<div class="container-fluid p-5">
			<div class="row">
				<div class="col-sm-12 mt-3">
					<form action="" method="POST">
						<input type="hidden" name="edit_id" id="edit_id"/>
						<input type="text" name="Name" id="Name" placeholder="Name"class=" p-1"/>
						<input type="date" name="HireDate" id="HireDate" placeholder="HireDate"class=" p-1"/>
						<input type="text" name="Email" id="Email" placeholder="Email"class=" p-1"/>
						<input type="number" name="Phon" id="Phon" placeholder="Phon"class=" p-1"/>
						<input type="text" name="Address" id="Address" placeholder="Address"class=" p-1"/>
						<input type="submit" value="submit" class="btn" />
					</form>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12 mt-3">
					<table class="table mt-3 table-bordered">
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>HireDate</th>
							<th>Email</th>
							<th>Phon</th>
							<th>Address</th>
						</tr>
						<?php 
							$sql = "SELECT * FROM librarians";
							$result = mysqli_query($connect, $sql);
							
							if(mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_assoc($result)){
						?>
							<tr>
								<td><?php echo $row['LibrarianID']; ?></td>
								<td><?php echo $row['Name']; ?></td>
								<td><?php echo $row['HireDate']; ?></td>
								<td><?php echo $row['Email']; ?></td>
								<td><?php echo $row['Phon']; ?></td>
								<td><?php echo $row['Address']; ?></td>
								
								<td>
								<a class="btn " href="librarina.php?delete_id=<?php echo $row['LibrarianID']; ?>" onclick="return confirm('Sure?');">Delete</a>
								
									<button class="btn "onclick="editlibrarians('<?php echo $row['LibrarianID']; ?>' , '<?php echo $row['Name']; ?>' ,
									'<?php echo $row['HireDate']; ?>' , '<?php echo $row['Email']; ?>' , '<?php echo $row['Phon']; ?>','<?php echo $row['Address']; ?>')">Edit</button>
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
						function editlibrarians(edit_id, Name, HireDate, Email, Phon, Address){
							document.getElementById("edit_id").value = edit_id;
							document.getElementById("Name").value = Name;
							document.getElementById("HireDate").value = HireDate;
							document.getElementById("Email").value = Email;
							document.getElementById("Phon").value = Phon;
							document.getElementById("Address").value = Address;
						}
					</script>
					
					
				</div>
			</div>
		</div>
		
	</body>
</html>
