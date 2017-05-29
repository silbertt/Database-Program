<!-- Casey Sanders & Teage Silbert
CS340 Final Project
3/10/16
Golf Database-->

<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","silbertt-db","01HtUZMOhswrdLEm","silbertt-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

//Create SQL query to add a course
if(!($stmt = $mysqli->prepare("INSERT INTO courses(name, tid) VALUES (?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

//utilize user input in the above query
if(!($stmt->bind_param("si",$_POST['courseName'], $_POST['tournaments']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

//Inform user if the course was successfully added or if it failed
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "<p> Added " . $stmt->affected_rows . " rows to courses.</p>";
    echo "<a href=\"HTML_Final_V1.2.php\">Go Back </a>";
}
?>