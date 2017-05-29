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

//create deletion statement 
if(!($stmt = $mysqli->prepare("DELETE FROM courses WHERE id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

//obtain user submitted data to use in DELETE query
if(!($stmt->bind_param("i",$_POST['course']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

//Inform user of successful delete or fail
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Deleted " . $stmt->affected_rows . " rows from courses.";
    echo "<a href=\"HTML_Final_V1.2.php\">Go Back </a>";
}
?>