<!-- Casey Sanders & Teage Silbert
CS340 Final Project
3/10/16
Golf Database-->

<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database

//connect to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","silbertt-db","01HtUZMOhswrdLEm","silbertt-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
//make call to the DB to insert data into golfers table
if(!($stmt = $mysqli->prepare("INSERT INTO golfers(first_name, last_name, region) VALUES (?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

//take user input and bind into query
if(!($stmt->bind_param("ssi",$_POST['FirstName'],$_POST['LastName'],$_POST['region']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

//inform user if query failed or was successful
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to golfers.";
    echo "<a href=\"HTML_Final_V1.2.php\">Go Back </a>";
}
?>