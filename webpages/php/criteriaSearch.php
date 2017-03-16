<?php
	readfile("header.html");
	
	$address_city = $_GET["address_city"];
	$noOfRooms = $_GET["noOfRooms"];
	$lowRent = $_GET["lowRent"];
	$highRent = $_GET["highRent"];

	echo "<h2> Properties in $address_city with $noOfRooms rooms with rent greater than $lowRent but less than $highRent: </h2> ";

	include_once "connect.php";
        
$sql = "SELECT address_street, address_city, address_zip, noOfRooms, monthlyRent FROM Rental_Property WHERE address_city = '$address_city' AND noOfRooms = $noOfRooms AND monthlyRent BETWEEN $lowRent AND $highRent";
                $sql_statement = OCIParse($conn, $sql);
                OCIExecute($sql_statement);
                $num_columns = OCINumCols($sql_statement);
                echo "<table border=1 class='table'>";
                echo "<tr><th>Street</th><th> City </th><th> Zip </th> <th> Number of Rooms </th> <th> Montly Rent </th></tr>";

                while(OCIFetch($sql_statement)){
                        echo "<tr>";
                        for($i = 1; $i <= $num_columns; $i++){
                                $column_value = OCiResult($sql_statement, $i);
                                echo "<td> $column_value </td>";
                        }
                        echo "</tr>";
                }

                echo '</table>';

                echo "<h2><a href='/~jroof/GreenfieldRMS/search.php'>BACK</a></h2>";	

		readfile("footer.html");

?>
