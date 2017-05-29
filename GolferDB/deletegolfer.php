<!-- Casey Sanders & Teage Silbert
CS340 Final Project
3/10/16
Golf Database-->

<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","silbertt-db","01HtUZMOhswrdLEm","silbertt-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

//Select the Deletion Row
if(!($stmt = $mysqli->prepare("DELETE FROM golfers WHERE id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

//Use input from the source file
if(!($stmt->bind_param("i",$_POST['golfer']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

//Inform user of status
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Deleted " . $stmt->affected_rows . " rows from golfers.";
    echo "<a href=\"HTML_Final_V1.2.php\">Go Back </a>";
}
?>