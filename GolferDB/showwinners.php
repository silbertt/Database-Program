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

<!--Create table to show data from DB-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<div>
    
    <fieldset>
        <legend>Winners</legend>
	       <table>
                <thead>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Year</th>
                    <th>Tournament</th>
                    <th>Course</th>
                </thead>
<?php
               
//send query to DB to obtain necessary data
if(!($stmt = $mysqli->prepare("SELECT g.first_name, g.last_name, r.year, t.name, c.name FROM results r INNER JOIN tournaments t on r.tid = t.id INNER JOIN courses c on c.id = r.cid INNER JOIN golfers g on g.id = r.winner WHERE t.id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

//Utilize the tournament id to assist in pulling winner data
if(!($stmt->bind_param("i",$_POST['tournament']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($first_name, $last_name, $year, $tname, $cname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
               
//create additional table holding the results from query
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $first_name . "\n</td>\n<td>\n" . $last_name . "\n</td>\n<td>\n" . $year . "\n</td>\n<td>\n" . $tname . "\n</td>\n<td>\n" . $cname ."\n</td>\n</tr>";

}
echo "<a href=\"HTML_Final_V1.2.php\">Go Back </a>";   
              
$stmt->close();
              
?>
	   </table>
    </fieldset>
</div>

</body>
</html>