<!-- Casey Sanders & Teage Silbert
CS340 Final Project
3/10/16
Golf Database-->

<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","silbertt-db","01HtUZMOhswrdLEm","silbertt-db");

?>

<!--Create a table to display the number of wins-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<div>
  
    <fieldset>
        <legend>Wins</legend>
	       <table>
                <thead>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Number of Wins</th>
                
                </thead>
<?php
               
//make call to DB                
if(!($stmt = $mysqli->prepare("SELECT g.first_name, g.last_name, COUNT(t.name) FROM results r INNER JOIN tournaments t on r.tid = t.id INNER JOIN courses c on c.id = r.cid INNER JOIN golfers g on g.id = r.winner WHERE g.id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['golfer']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($first_name, $last_name, $tname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
               
//create table holding values from the golfers table in the DB               
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $first_name . "\n</td>\n<td>\n" . $last_name . "\n</td>\n<td>\n" . $tname . "\n</td>\n<td>\n";
}
echo "<a href=\"HTML_Final_V1.2.php\">Go Back </a>"; 

$stmt->close();

?>
	   </table>
    </fieldset>
</div>

</body>
</html>