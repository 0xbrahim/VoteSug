<?php
    // Check if form data is submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Retrieve the values from the URL parameters
        $user_id = $_GET["user_id"];
        $suggestion_id = $_GET["suggestion_id"];
        $vote = $_GET["vote"];

        // Print the retrieved values
        $db_host = 'localhost';
        $db_name = 'votesug_db';
        $db_user = 'root';
        $db_pass = '';

        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    }

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the record already exists in the votes table
    $stmt = $conn->prepare("SELECT * FROM votes WHERE user_id = :user_id AND sugg_id = :suggestion_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':suggestion_id', $suggestion_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // If the record exists, update the vote value
        $stmt = $conn->prepare("UPDATE votes SET vote = :vote WHERE user_id = :user_id AND sugg_id = :suggestion_id");
        $stmt->bindParam(':vote', $vote);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':suggestion_id', $suggestion_id);
        $stmt->execute();
        echo "Record updated successfully";
    } else {
        // If the record does not exist, insert a new row
        $stmt = $conn->prepare("INSERT INTO votes (user_id, sugg_id, vote) VALUES (:user_id, :suggestion_id, :vote)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':suggestion_id', $suggestion_id);
        $stmt->bindParam(':vote', $vote);
        $stmt->execute();
        echo "New record created successfully";
    }

    // Close the database connection
    $conn = null;
	header ("Location: TeamMember.php");
?>