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
		
		
		if(empty($_POST['bookName'])){
			$bookName = null;
		}else{
			$bookName= $_POST['bookName'];
		}
		if(empty($_POST['buyerName'])){
			$buyerName = null;
		}else{
			$buyerName= $_POST['buyerName'];
		}
		if(empty($_POST['saleDate'])){
			$saleDate = null;
		}else{
			$saleDate = $_POST['saleDate'];
		}
		if(empty($_POST['price'])){
			$price = null;
		}else{
			$price = $_POST['price'];
		}
		
	
		
		if(isset($_POST['edit_id']) && !empty($_POST['edit_id'])){
			//Edit sales Info
			$edit_id = (int)$_POST['edit_id'];
			$sql = "UPDATE sales SET bookName='$bookName',  buyerName='$buyerName',  saleDate='$saleDate',  price='$price' WHERE salesID=$edit_id";
			if(!mysqli_query($connect, $sql)){
				die("Edit Error: " . mysqli_error($connect));
			}
		}else{
			//Insert new sales
			$sql = "INSERT INTO sales (bookName, buyerName, saleDate,price) VALUES('$bookName','$buyerName','$saleDate','$price')";
			if(!mysqli_query($connect, $sql)){
				die("Insert Error: " . mysqli_error($connect));
			}
		}
		header("Location: sales.php");
		exit;
		header("Location: sales.php");
		exit;
	}
	
	
	
	//Delete sales
	if (isset($_GET['delete_id'])){
		$delete_id = (int)$_GET['delete_id'];
		$sql = "DELETE FROM sales WHERE salesID=$delete_id";
		if(!mysqli_query($connect, $sql)){
			die("Delete Error: " . mysqli_error($connect));
		}
		header("Location: sales.php");
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
						<input type="text" name="bookName" id="bookName" placeholder="BookName"class=" p-1"/>
						<input type="name" name="buyerName" id="buyerName" placeholder="buyerName"class=" p-1"/>
						<input type="date" name="saleDate" id="saleDate" placeholder="saleDate"class=" p-1"/>
						<input type="numbar" name="price" id="price" placeholder="price"class=" p-1"/>
						<input type="submit" value="submit" class="btn" class=" p-1"/>
					</form>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12 mt-3">
					<table class="table mt-3 table-bordered">
						<tr>
							<th>ID</th>
							<th>BookName</th>
							<th>buyerName</th>
							<th>saleDate</th>
							<th>price</th>
							
						</tr>
						<?php 
							$sql = "SELECT * FROM sales";
							$result = mysqli_query($connect, $sql);
							
							if(mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_assoc($result)){
						?>
							<tr>
								<td><?php echo $row['salesID']; ?></td>
								<td><?php echo $row['bookName']; ?></td>
								<td><?php echo $row['buyerName']; ?></td>
								<td><?php echo $row['saleDate']; ?></td>
								<td><?php echo $row['price']; ?></td>
								
								
								<td>
									<a class="btn"href="sales.php?delete_id=<?php echo $row['salesID']; ?>" onclick="return confirm('Sure?');">Delete</a>
									
									<button class="btn"onclick="editsales('<?php echo $row['salesID']; ?>' , '<?php echo $row['bookName']; ?>' ,
									'<?php echo $row['buyerName']; ?>' , '<?php echo $row['saleDate']; ?>' , '<?php echo $row['price']; ?>',)">Edit</button>
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
						function editsales(edit_id, bookName, buyerName, saleDate, price){
							document.getElementById("edit_id").value = edit_id;
							document.getElementById("bookName").value = bookName;
							document.getElementById("buyerName").value = buyerName;
							document.getElementById("saleDate").value = saleDate;
							document.getElementById("price").value = price;
							
						}
					</script>
					
					
				</div>
			</div>
		</div>
		
	</body>
</html>
