<?php
	readfile("header.html");
	include_once "connect.php";

	$town = $_GET["town"];
	echo "<h2>$town average rent: </h2> <br />";

	$sql = "SELECT AVG(monthlyRent) FROM Rental_Property WHERE address_city = '$town' GROUP BY address_city";
	$sql_statement = OCIParse($conn, $sql);
	OCIExecute($sql_statement);
	$num_columns = OCINumCols($sql_statement);
	while (OCIFetch($sql_statement)) {
             	$average = OCIResult($sql_statement, 1);
		$roundedAverage = round($average, 2); //Truncate
		echo "<h1> $$roundedAverage </h1>";
                        
        }
	
	echo "<br >";

	echo "<h2><a href='/~jroof/GreenfieldRMS/view.php'> BACK </a></h2>";

	readfile("footer.html");

?>
