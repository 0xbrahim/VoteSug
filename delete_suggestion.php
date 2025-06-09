<?php
include("db_conn.php");

$id = $_GET['id'];
# delete the suggestion from the database:
$sql = "DELETE FROM suggestions WHERE suggestion_id ='" . $_GET["id"] ."'";

if(mysqli_query($conn, $sql)){
		header("Location: TeamLead.php");
}else{
	echo "Error" . mysqli_error($conn);	
}
mysqli_close($conn);

?>