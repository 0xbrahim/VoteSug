<?php
	session_start();
    if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
		header("Location: logout.php");
	    exit;
	}		
	
	# if Team member try to access this page by typing the name of this page in the URL, It will logout
	if($_SESSION["type"] !== "TeamLead"){
		header("Location: logout.php");
	    exit;	
	}

?>

<?php

	// Connect to MySQL		
	$mysqli = new mysqli("localhost", "root", "", "votesug_db");

	// Check connection
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}

	// Fetch data from the suggestions table
	$sql = "SELECT * FROM suggestions";
	$result = $mysqli->query($sql);
	
?>

<!DOCTYPE html>
<html>
	
	<head>
		
		<title>Team Lead</title>
		
		<meta charset="utf-8" />
	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="TeamLead_CascadingStyleSheets.css" />
		
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	
		<link rel="icon" href="VoteSug-small.png" />
		
		<style type="text/css">
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

			<!-- Create Suggestions button & Sign out button -->
			<div class="row">
				<div class="col-sm-3">
					<!-- Create Suggestions button -->
					<button class="open-buttonCS" onclick="openForm()">Create suggestion</button>
				</div>
				
				<div class="col-sm-3">	
					<!-- Sign out button -->
					<button class="open-buttonSo" onclick="window.location.href='logout.php' ">Sign out</button>	
				</div>
			</div>
		
		
			<!-- print Hi Team lead and his name-->
			<h1 style="text-align: center; font-size:2.5em; background-color: lightgray;">
				<?php echo  "Hi <span style=color:blue;>" ."Team Lead". "</span>"."<br>" ."Welcome ".$_SESSION['user_name'];?>
			</h1>
		
			
			<!-- Create Suggestions -->
			<div class="form-popup" id="myForm">
				<div class="container mt-3" class="form-container">	
				
					<?php
					if (!IsSet($_POST["suggestion"])) {
					?>
					
					<form action  = "http://localhost/TeamLead.php" onsubmit="return whitespaceError()" method = "POST">
						<div class="mb-3 mt-3">
						
						<textarea class="form-control" rows="6" cols="80" id="suggg" name="suggestion" maxlength="300" placeholder="Write your suggestion Here (Should not exceed 300 characters)" style="resize: none;" required></textarea>
						
						</div>
						<center>
						
							<input type="submit"  name ="submit" value="Submit" class="btn btn-primary" style="border:solid; border-width:thin;" />
							
							<input type="reset" class="btn btn-secondary" value="Cancel" style="border:solid; border-width:thin;" />
							
							<button type="button" class="btn btn-danger cancel" onclick="closeForm()" style="padding: 0%; width:10%; position: absolute; left: 10px; margin-top: -210px; border:solid; border-width:thin;">X</button>
							
						</center>
					</form>
					
					<!-- this php code will send the suggestion to the database. By the way I took this php code from (namesexample2.php) this file in moodle -->
					<?php
					} else {
						
					// Connect to MySQL
					$db = mysqli_connect("localhost", "root", "","votesug_db");
					if (!$db) {
					print "Error - Could not connect to MySQL";
					exit;
					}

					// Get the query and clean it up (delete leading and trailing 
					// whitespace and remove backslashes from magic_quotes_gpc)
					$suggestion = trim($_POST['suggestion']);
					$query = "insert into suggestions(suggestion) values ('".$suggestion."');";

					// Execute the query
					$result = mysqli_query($db,$query);
					if (!$result) {
					print "Error - the query could not be executed";
					$error = mysqli_error();
					print "<p>" . $error . "</p>";
					exit;
					}
					header("Location: TeamLead.php");
					}
					?>
					
				</div>
			</div>
			
			
		
			<center>
				<div style="border: solid; border-width: thin; background-color: lightgray; height:500px; width: 1200px;  overflow: scroll;">
					
				<table>
					<tr>
						<th>Suggestion number</th>
						<th>Suggestion</th>
						<th>Creation Date</th>
						<th>Delete</th>
					</tr>
					
					<?php
					// Loop through the result set and display data in table rows
					while ($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td>" . $row['suggestion_id'] . "</td>";
						echo "<td>" . $row['suggestion'] . "</td>";
						echo "<td>" . $row['creationdate'] . "</td>";
						echo "<td>" . "<a class=open-buttonDelete href = 'delete_suggestion.php?id=$row[suggestion_id]'>Delete</a>". "</td>";
						echo "</tr>";
					}
					?>
				</table>
				
				<div class="container-fluid mt-3">
					<!-- votes button-->
					<button class="open-buttonDet" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">Votes</button>
				</div>
				
				</div>
				
			</center>
				
			<!-- offcanvas from bootstarp -->	
			<!-- When team lead press votes button this will apear: offcanvas model-->
			<div class="offcanvas offcanvas-top" id="demo" style="height: 60%; width: 100%;">
			
				<div class="offcanvas-header">
					<!--close button-->
					<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
				</div>
				
				
				<div style="background-color: white; height: 100%; width: 100%;  overflow: scroll;">
							
					<?php
					// Connect to MySQL
					$mysqli = new mysqli("localhost", "root", "", "votesug_db");

					// Check connection
					if ($mysqli->connect_error) {
						die("Connection failed: " . $mysqli->connect_error);
					}

					// Fetch data from the suggestions table
					$sql = "SELECT s.suggestion_id, s.suggestion, 
						   COUNT(CASE WHEN v.vote = 'yes' THEN 1 END) AS yes,
						   COUNT(CASE WHEN v.vote = 'no' THEN 1 END) AS no,
						   COUNT(CASE WHEN v.vote = 'not_decided' THEN 1 END) AS undecided
						   FROM suggestions s
						   LEFT JOIN votes v ON s.suggestion_id = v.sugg_id
						   GROUP BY s.suggestion_id, s.suggestion";
					$result = $mysqli->query($sql);
					?>
					
					
					<table style="width: 100%; margin-top: 25px;">
						<tr>
							<th>Suggestion number</th>
							<th>Suggestion</th>
							<th>Yes</th>
							<th>No</th>
							<th>Undecided</th>
						</tr>
					
						<?php
						// Loop through the result set and display data in table rows
						while ($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row['suggestion_id'] . "</td>";
							echo "<td>" . $row['suggestion'] . "</td>";
							echo "<td>" . $row['yes'] . "</td>";
							echo "<td>" . $row['no'] . "</td>";
							echo "<td>" . $row['undecided'] . "</td>";
							echo "</tr>";
						}
						?>
					</table>
				</div>	
			</div>
				
			<br />
			

			<script type="text/javascript">
				// When the user clicks the button, open the popup form
				function openForm() {
					document.getElementById("myForm").style.display = "block";
				}
				// When the user clicks (close), close the popup form
				function closeForm() {
					document.getElementById("myForm").style.display = "none";
				}
			
				// this function (whitespaceError) I took it from a youtube video: https://www.youtube.com/watch?v=VJLCYGzTN5E
				// prevent user to send whitespace input
				function whitespaceError(){
					var sugg = document.getElementById("suggg").value;
					if(sugg.replace(/\s/g, "").length <= 0){
					alert("Suggestion cannot be a whitespace!");
					return false;
				}	
			}
			
			</script>
		
		
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