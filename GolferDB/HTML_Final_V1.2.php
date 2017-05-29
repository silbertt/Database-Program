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
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<div>
    <fieldset>
	   <!-- to show golfers -->
        <legend>Golfer List</legend>
            <table>
                <thead>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Region of Origin</th>
                </thead>
<?php
//Connect to SQL database sending request statment for output                
if(!($stmt = $mysqli->prepare("SELECT g.first_name, g.last_name, r.name FROM golfers g INNER JOIN region r ON g.region = r.id ORDER BY last_name ASC"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($fname, $lname, $region)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $region . "\n</td>\n</tr>";
}
$stmt->close();
?>

            </table>
    </fieldset>
</div>

<div>
	<form method="post" action="addgolfer.php"> 
    <!-- To allow user to add a golfer to the DB -->    
    <fieldset>   
        <legend>Add Golfer</legend>
		<fieldset>
			<legend>Name</legend>
			<p>First Name: <input type="text" name="FirstName" /></p>
			<p>Last Name: <input type="text" name="LastName" /></p>
		</fieldset>
		<fieldset>
			<legend>Region of Origin</legend>
			<select name="region">
    </fieldset> 
            
<?php
            
// Setup a dropdown menu for the user to choose form the region table
if(!($stmt = $mysqli->prepare("SELECT id, name FROM region"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $gname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $gname . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
        <!-- send data to file-->
		<p><input type="submit" /></p>
	</form>
</div>
    
<div>
	<form method="post" action="addtournament.php"> 

    <!-- To allow the user to add a tournament-->        
    <fieldset>   
        <legend>Add Tournament</legend>
		<fieldset>
			<p>Tournament Name: <input type="text" name="Name" /></p>
		</fieldset>
		<fieldset>
			<legend>Course</legend>
			<select name="course">
    </fieldset> 
            
<?php
//setup dropdown for course
if(!($stmt = $mysqli->prepare("SELECT id, name FROM courses"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $cname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $cname . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
        <fieldset>
			<legend>Winner</legend>
			<select name="golfer">
    </fieldset> 
            
<?php
//setup dropdown for golfers
if(!($stmt = $mysqli->prepare("SELECT id, first_name, last_name FROM golfers"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $fname . ' ' . $lname . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
        <fieldset>
			<p>Year: <input type="text" name="Year" /></p>
		</fieldset>
        <!-- send data to file -->
		<p><input type="submit" /></p>
	</form>
</div>
    
<div>
	<form method="post" action="addcourse.php"> 
    <!-- Allow user to add course to the DB-->
    <fieldset>   
        <legend>Add Course</legend>
		<fieldset>
			<legend>Course</legend>
			<p>Course Name: <input type="text" name="courseName" /></p>
        </fieldset>
		<fieldset>
			<legend>Tournament Association</legend>
			<select name="tournaments">
    </fieldset> 
            
<?php
//setup dropdown menu for tournaments
if(!($stmt = $mysqli->prepare("SELECT id, name FROM tournaments"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $tname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $tname . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
        <!-- send data to addcourse file-->
		<p><input type="submit" /></p>
	</form>
</div>    
    

<div>
	<form method="post" action="showwinners.php"> 
    <!--allow user to select winners of tournaments-->
    <fieldset>   
        <legend>Show Tournament Winners</legend>
		<fieldset>
			<legend>Select Tournament</legend>
			<select name="tournament">
    </fieldset> 
            
<?php
//create dropdown menu of all tournaments
if(!($stmt = $mysqli->prepare("SELECT id, name FROM tournaments"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $tname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $tname . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
        <!--send data to showwinners file-->
		<p><input type="submit" /></p>
	</form>
</div>
    
<div>
	<form method="post" action="showwins.php"> 
        
    <!--allow user to select tournament winners by golfer-->    
    <fieldset>   
        <legend>Show Tournament Wins By Golfer</legend>
		<fieldset>
			<legend>Select Golfer</legend>
			<select name="golfer">
    </fieldset> 
            
<?php
//create the dropdown list for golfers
if(!($stmt = $mysqli->prepare("SELECT id, first_name, last_name FROM golfers"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $fname . ' ' . $lname . '</option>\n';
}
$stmt->close();
?>
          		</select>
		</fieldset>
        <!--send data to nowins file-->
		<p><input type="submit" /></p>
	</form>
</div>
    
<div>
	<form method="post" action="nowins.php"> 
        
    <!--allow user to select number of wins by golfer-->    
    <fieldset>   
        <legend>Number of Wins by Golfer</legend>
		<fieldset>
			<legend>Select Golfer</legend>
			<select name="golfer">
    </fieldset> 
            
<?php
//create the dropdown list for golfers
if(!($stmt = $mysqli->prepare("SELECT id, first_name, last_name FROM golfers"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $fname . ' ' . $lname . '</option>\n';
}
$stmt->close();
?>
          		</select>
		</fieldset>
        <!--send data to nowins file-->
		<p><input type="submit" /></p>
	</form>
</div>    
    
<div>
	<form method="post" action="deletegolfer.php"> 

            <!--allow users to delete a golfer-->
    <fieldset>   
        <legend>Delete Golfer</legend>
		<fieldset>
			<legend>Select Golfer (Please Note Constrainsts May Prevent Deletion)</legend>
			<select name="golfer">
    </fieldset> 
            
<?php
//create dropdown of all golfers
if(!($stmt = $mysqli->prepare("SELECT id, first_name, last_name FROM golfers"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $fname . ' ' . $lname . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
        <!--send data to deletegolfer file-->
		<p><input type="submit" /></p>
	</form>
</div>
    
<div>
	<form method="post" action="deletecourse.php"> 
        
    <!--Allow user to delete a golf course-->    
    <fieldset>   
        <legend>Delete Course</legend>
		<fieldset>
			<legend>Select Course (Please Note Constrainsts May Prevent Deletion)</legend>
			<select name="course">
    </fieldset> 
            
<?php
//create the dropdown showing all of the courses
if(!($stmt = $mysqli->prepare("SELECT id, name FROM courses"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $cname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $cname . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
        <!-- send data to deletecourse file-->
		<p><input type="submit" /></p>
	</form>
</div>
    
<div>
	<form method="post" action="deletetournament.php"> 
        
    <!--Allow user to delete tournament-->    
    <fieldset>   
        <legend>Delete Tournament</legend>
		<fieldset>
			<legend>Select Tournament (Please Note Constrainsts May Prevent Deletion)</legend>
			<select name="tournament">
    </fieldset> 
            
<?php
//create dropdown menu showing all tournaments
if(!($stmt = $mysqli->prepare("SELECT id, name FROM tournaments"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $tname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $tname . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
        <!-- send data to deletetournament file-->
		<p><input type="submit" /></p>
	</form>
</div>    




</body>
</html>