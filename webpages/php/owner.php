<?php

	readfile("header.html");
	include_once "connect.php";

	$ownerId = $_GET["ownerId"];
	echo "<h2>All of the properties owned by owner: $ownerId</h2>";
	$sql = "SELECT owner.ownerId,owner.first_Name,owner.Last_Name,Rental_Property.rentalNo,Rental_Property.address_street,Rental_Property.address_city,rental_property.address_zip FROM Owner INNER JOIN Rental_Property ON Owner.ownerId = '$ownerId' AND Rental_Property.ownerId = '$ownerId'";

	$sql_statement = OCIParse($conn, $sql);
	OCIExecute($sql_statement);
	$num_columns = OCINumCols($sql_statement);
	
	echo "<table border=1 class='table'>";
	echo "<tr><th>Employee Id</th><th> First Name </th><th> Last Name </th> <th> RentalNo </th> <th> Street </th><th> City </th><th> Zip </th></tr>";

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
