<?php
include "db_conn.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	# access value of username & password:
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT user_id, type, password FROM users WHERE BINARY username = '$username' and MD5(password) = MD5('$password')";
	# BINARY in the sql query, I took it from stack over flow website. to make username case sensitive
    $result = mysqli_query($conn,$sql); 
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
        $type = $row['type'];
		
		# if username is correct & password is correct & user type is Team member go to this page: TeamMember.php  
        if($type === "TeamMember" && $password === $row['password']){
            session_start();
            $_SESSION["username"] = $row["username"];
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["logged_in"] = true;
			$_SESSION["type"] = "TeamMember";
			
			$_SESSION['user_name'] = $username;
            header ("Location: TeamMember.php"); 
            die();
			
			# if username is correct & password is correct & user type is Team Lead go to this page: TeamLead.php 
        }else if($type === "TeamLead" && $password === $row['password']){
            session_start();
            $_SESSION["username"] = $row["username"];
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["logged_in"] = true;
			$_SESSION["type"] = "TeamLead";	
				
			$_SESSION['user_name'] = $username;
            header ("Location: TeamLead.php"); 
            die();

        }else{
			# if username & password is wrong stay in the same page and print the error
            header("Location: Index.php");
            $error_message = 'Invalid username or password';
        }
    } else {
       
			$error_message = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html>
	
	<head>
		
		<title>VoteSug</title>
		
		<meta charset="utf-8" />
	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		
		<link rel="stylesheet" type="text/css" href="Index_CascadingStyleSheets.css" />
		
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	
		
		<link rel="icon" href="VoteSug-small.png" />
	</head>
	
	
	<body class="bg">
	
		<img src="VoteSug-png.png" alt="VoteSug" width="400" />
		
		<button class="open-button" onclick="openForm()">Sign in</button>
		
			<!--I took this popup form from this site : https://www.w3schools.com/howto/howto_js_popup_form.asp -->
			<div class="form-popup" id="myForm">
			
				<form action="Index.php" onsubmit="return whitespaceError()" method="POST" class="form-container">
					<br>
					
					<center>
						<h6 style="font-size:1.5em; color: white;">Sign in</h6>
					</center>
					
					<br />
					
				<!--Print alert if user make mistake in username or password-->
				<?php if (isset($error_message)) { ?>
				<p  class="alert alert-danger" style="color: black; font-size:0.9em;"><?php echo $error_message; ?></p>
				<?php } ?>
						
				<input type="text" class="form-control" placeholder="Username" id="username" name="username" required />
				
				<input type="password" class="form-control" placeholder="Password" minlength="5" id="password" name="password" required />
				
				<input type="submit" name="submit" value="Sign in" class="btn btn-primary" />
				
				<button type="button" class="btn btn-danger cancel" onclick="closeForm()">Close</button>
				
			</form>
		</div>

		<!-- open the form after the mistake from the user and display the alert-->
		<?php if (isset($error_message)) { ?>
			<script type="text/javascript">
				document.getElementById("myForm").style.display = "block";
			</script>
		<?php } ?>


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
			var user = document.getElementById("username").value;
			var pass = document.getElementById("password").value;
			
			if(user.replace(/\s/g, "").length <= 0){
				
				alert("Username cannot be a whitespace!");
				return false;
			}	
			
			if(pass.replace(/\s/g, "").length <= 0){
				
				alert("Password cannot be a whitespace!");
				return false;
			}
		}
		
	</script>
				
				
			<h3 style="text-align:center; font-family:'Arial Black'; color: #1e517b; font-size:2.5em;">Welcome to <br />
				<span style="font-size:2em;"> VoteSug Website </span> <br />
			</h3>
			
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
				
		<footer>
			<div style="color: white;">
				<h3 style="text-align:center;">About us</h3>
				<p style="text-align: center; font-weight:bold;">
				We are a team of students who made a website for the online voting of suggestions that has been created by the team leader.
				</p>
			</div>
			
			<br />
			
			<p style="color:black;">Copyright &copy; 2023 VoteSug. All rights reserved.</p>
		</footer>
	
	</body>

</html>