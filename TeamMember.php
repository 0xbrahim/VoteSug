<?php
	session_start();
	if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
		header("Location: logout.php");
		exit;	  
	}
	
	# if Team Lead try to access this page by typing the name of this page in the URL, It will logout
	if($_SESSION["type"] !== "TeamMember"){
		header("Location: logout.php");
	    exit;
	}
?>
<?php
	$db_host = 'localhost';
	$db_name = 'votesug_db';
	$db_user = 'root';
	$db_pass = '';
	
	# Access the database by PDO
	// PDO : PHP Data Objects
	$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
?>

<?php
	$user_name = $_SESSION['user_name'];
	$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
	
	<head>
		
		<title>Team member</title>
		
		<meta charset="utf-8" />
	
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet" type="text/css" href="TeamMember_CascadingStyleSheets.css" />
		
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	
		<link rel="icon" href="VoteSug-small.png" />
		
		<style type="text/css">
		h1 {
			text-align: center;
			margin-top: 30px;
			color: #333;
		}

		table {
			width: 100%;
			margin: 0 auto;
			border-collapse: collapse;
			margin-top: 50px;
			background-color: #fff;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
		}

		th, td {
			padding: 15px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		tr:hover {
			background-color: #ddd;
		}
		
		</style>

	</head>
	
		
	<body class="bg">
	
		<img src="VoteSug-png.png" alt="VoteSug" width="400" />
	
	
			<div class="row">
				<div class="col-sm-3">
					<!-- Sign out button -->
					<button class="open-buttonSo" onclick="window.location.href='logout.php' ">Sign out</button>	
				</div>
			</div>
		
		<!-- print Hi Team lead and his name-->
		<h1 style="text-align: center; font-size:2.5em; background-color: lightgray;">
			<?php echo  "Hi <span style=color:blue;>" ."Team Member". "</span>"."<br>" ."Welcome ".$user_name; ?>
		</h1>
	
	
		<center>
			<!-- div inside it table of suggestions -->
			<div style="border: solid; border-width: thin; background-color: lightgray; height:500px; width: 1200px;  overflow: scroll;">
			
				<?php
				$stmt = $conn->query("SELECT suggestion_id, suggestion, creationdate FROM suggestions");

				echo "<table>";
				echo "<tr><th>Suggestion number</th><th>Suggestion</th><th>Creation Date</th><th>Vote</th><th>Submit</th></tr>";
				
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						echo "<tr>";
							echo "<td>" . $row['suggestion_id'] . "</td>";
							echo "<td>" . $row['suggestion'] . "</td>";
							echo "<td>" . $row['creationdate'] . "</td>";
							echo "<td>";
							
							echo "<form action='vote.php' method='get'>";
							echo "<input type='hidden' name='user_id' value='" . $user_id . "'>";
							echo "<input type='hidden' name='suggestion_id' value='" . $row['suggestion_id'] . "'>";
								# Drop down menu:
							echo "<select name='vote'>";
							echo "<option value='not_decided'>Undecided</option>";
							echo "<option value='yes'>Yes</option>";
							echo "<option value='no'>No</option>";
							echo "</select>";
							
							echo "</td>";
							echo "<td><input type='submit' name='submit' value='Submit' class='my-button'></td>";
							echo "</form>";
						echo "</tr>";
					}
				echo "</table>";

				$conn = null;
				?>
			</div>
			
		</center>
	
		<br />
	
		<footer>
			<div style="color: white;">
				<h3 style="text-align:center;">About us</h3>
				
				<p style="text-align: center; font-weight:bold;">
				We are a team of students who made a website for the online voting of suggestions that has been created by the team leader.
				</p>
				
			</div>
		
			<br />
			
			<p style="color: black;">Copyright &copy; 2023 VoteSug. All rights reserved.</p>
			
		</footer>
		
	</body>
	
</html>