<?php
	readfile("header.html");
	include_once "connect.php"; 

	echo "<h3> All available properties </h2>";
    	$sql = "SELECT rentalNo, address_street, address_city, address_zip, noOfRooms, monthlyRent  FROM Rental_Property WHERE status = 'Available'";

    	$sql_statement = OCIParse($conn, $sql);
    	OCIExecute($sql_statement);
    	$num_columns = OCINumCols($sql_statement);

    	echo "<TABLE BORDER=1 class='table'>";
    	echo "<TR><TH> Rental Number </TH><TH> Street </TH><TH> City </TH><TH> Zip </TH><TH> Number of Rooms</th><th> Rent </th>";
    
    	while (OCIFetch($sql_statement)) {
      		echo "<TR>";
      		for ($i = 1; $i <= $num_columns; $i++) {
        		$column_value = OCIResult($sql_statement, $i);
        		echo "<TD>$column_value</TD>";
      		}
      		echo "</TR>";
    	}
    echo "</TABLE>";

	echo "</table>";
	echo "<h2> 8) Show the renters who have rented more than 1 property </h2>";
	$sql1 = "SELECT renterId, first_name, last_name FROM Renter WHERE renterId IN (SELECT renterId FROM Lease_Agreement GROUP BY renterId HAVING COUNT(*)>1)";
	$sql_statement1 = OCIParse($conn, $sql1);
	OCIExecute($sql_statement1);
	$num_columns = OCINUmCols($sql_statement1);

	echo "<table border=1 class='table'>";
	echo "<tr><th> Renter Id </th><th> First Name </th> <th> Last Name </th></tr>";
	while(OCIFetch($sql_statement1)){
		echo "<tr>";
		for($i = 1; $i <= $num_columns; $i++){
			$column_value = OCIResult($sql_statement1, $i);
			echo "<td> $column_value </td>";
		}
		echo "</tr>";
	}
	echo "</table>";

	echo "<h2> 9) Show the average rent for properties in a town (name of town in entered as input) </h2>";
	echo "<form action='town.php' method='get'>";
	echo "Town: <input type='text' name='town'><br>";
	echo "<input type='submit'>";
	echo "</form>";


	echo "<h2> 10)  Show the names and address of proerties whose leases will expire in the next two months</h2>
</body>";
	$sql2 = "SELECT Lease_Agreement.leaseID, Lease_Agreement.renterFirst_name, Lease_Agreement.renterLast_name,Rental_Property.rentalNo,Rental_Property.address_street,Rental_Property.address_city,rental_property.address_zip
FROM Lease_Agreement
INNER JOIN Rental_Property
ON Lease_Agreement.rentalNo = Rental_Property.rentalNo AND (Lease_Agreement.end_date-SYSDATE) <= 60";

        $sql_statement2 = OCIParse($conn, $sql2);
        OCIExecute($sql_statement2);
        $num_columns = OCINumCols($sql_statement2);

        echo "<TABLE BORDER=1 class='table'>";
        echo "<TR><TH>Lease Id </TH><TH> First Name </TH><TH> Last Name </TH><TH> Rental Number </TH><TH> Street </th><th> City </th><th> Zip </th></tr>";

        while (OCIFetch($sql_statement2)) {
                echo "<TR>";
                for ($i = 1; $i <= $num_columns; $i++) {
                        $column_value = OCIResult($sql_statement2, $i);
                        echo "<TD>$column_value</TD>";
                }
                echo "</TR>";
        }
    echo "</TABLE>";
	
	readfile("footer.html");
?>
