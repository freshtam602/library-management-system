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
		if(empty($_POST['JOINDATE'])){
			$JOINDATE= null;
		}else{
			$JOINDATE= $_POST['JOINDATE'];
		}
		if(empty($_POST['LastName'])){
			$LastName= null;
		}else{
			$LastName = $_POST['LastName'];
		}
		if(empty($_POST['Email'])){
			$Email = null;
		}else{
			$Email = $_POST['Email'];
		}
				if(empty($_POST['Phon'])){
			$Phon= null;
		}else{
			$Phon= $_POST['Phon'];
		}
			if(empty($_POST['Address'])){
			$Address= null;
		}else{
			$Address= $_POST['Address'];
		}
	
		
		if(isset($_POST['edit_id']) && !empty($_POST['edit_id'])){
			//Edit member Info
			$edit_id = (int)$_POST['edit_id'];
			$sql = "UPDATE members SET Name='$Name', JOINDATE='$JOINDATE',  LastName='$LastName', Email='$Email', Phon='$Phon,  Address='$Address' WHERE MemberID=$edit_id";
			if(!mysqli_query($connect, $sql)){
				die("Edit Error: " . mysqli_error($connect));
			}
		}else{
			//Insert new member
			$sql = "INSERT INTO MemberID (Name, JOINDATE,LastName, Email, Phon, Address) VALUES('$Name','$JOINDATE',LastName,'$Email','$Phon', '$Address')";
			if(!mysqli_query($connect, $sql)){
				die("Insert Error: " . mysqli_error($connect));
			}
		}
		header("Location: member.php");
		exit;
		header("Location: member.php");
		exit;
	}
	
	
	
	//Delete librarina
	if (isset($_GET['delete_id'])){
		$delete_id = (int)$_GET['delete_id'];
		$sql = "DELETE FROM librarians WHERE LibrarianID=$delete_id";
		if(!mysqli_query($connect, $sql)){
			die("Delete Error: " . mysqli_error($connect));
		}
		header("Location: member.php");
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
			
			<div class="row ">
				<div class="col-sm-12 mt-3">
					<form action="" method="POST">
						<input type="hidden" name="edit_id" id="edit_id"/>
						<input type="text" name="Name" id="Name" placeholder="Name"class=" p-1"/>
						<input type="date" name="JOINDATE" id="JOINDATE" placeholder="JOINDATE"class=" p-1"/>
						<input type="text" name="LastName" id="LastName" placeholder="LastName"class=" p-1"/>
						<input type="text" name="Email" id="Email" placeholder="Email"class=" p-1"/>
						<input type="number" name="Phon" id="Phon" placeholder="Phon"class=" p-1"/>
						<input type="text" name="Address" id="Address" placeholder="Address"class=" p-1"/>
						<input type="submit" value="submit" class="btn" />
					</form>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12 mt-2">
					<table class="table mt-3 table-bordered">
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>JOINDATE</th>
							<th>LastName</th>
							<th>Email</th>
							<th>Phon</th>
							<th>Address</th>
						</tr>
						<?php 
							$sql = "SELECT * FROM members";
							$result = mysqli_query($connect, $sql);
							
							if(mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_assoc($result)){
						?>
							<tr>
								<td><?php echo $row['MemberID']; ?></td>
								<td><?php echo $row['Name']; ?></td>
								<td><?php echo $row['JOINDATE']; ?></td>
								<td><?php echo $row['LastName']; ?></td>
								<td><?php echo $row['Email']; ?></td>
								<td><?php echo $row['Phon']; ?></td>
								<td><?php echo $row['Address']; ?></td>
								
								<td>
								<a class="btn"href="member.php?delete_id=<?php echo $row['MemberID']; ?>" onclick="return confirm('Sure?');">Delete</a>
									
									<button class="btn"onclick="editmembers('<?php echo $row['MemberID']; ?>' , '<?php echo $row['Name']; ?>' ,
									'<?php echo $row['JOINDATE']; ?>' ,'<?php echo $row['LastName']; ?>', '<?php echo $row['Email']; ?>' , '<?php echo $row['Phon']; ?>','<?php echo $row['Address']; ?>')">Edit</button>
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
						function editmembers(edit_id, Name, JOINDATE,LastName, Email, Phon, Address){
							document.getElementById("edit_id").value = edit_id;
							document.getElementById("Name").value = Name;
							document.getElementById("JOINDATE").value = JOINDATE;
							document.getElementById("LastName").value = LastName;
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
