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

//variable to hold new tournament ID 
$newTID = $_POST['Name'];

//query to add to tournaments
if(!($stmt = $mysqli->prepare("INSERT INTO tournaments(name) VALUES (?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

//utilize user datat within the tournament insertion query
if(!($stmt->bind_param("s",$_POST['Name']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

//Inform user if a tournament was added or if it failed
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to tournaments.";
}

//query to add winner and other results fields-Needed new tournament ID for this
if(!($stmt = $mysqli->prepare("INSERT INTO results(winner, year, cid, tid) VALUES (?,?,?,(SELECT id FROM tournaments WHERE tournaments.name = '$newTID'))"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

//utilize remaining user inputs to bind to the insert query for results
if(!($stmt->bind_param("iii",$_POST['golfer'], $_POST['Year'], $_POST['course']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

//inform user if tournament was successfully added
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to results.";
    echo "<a href=\"HTML_Final_V1.2.php\">Go Back </a>";
}
?>