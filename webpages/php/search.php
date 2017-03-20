<?php
	readfile("header.html");
	include_once "connect.php";

	echo "<h2> 1) Generate a list of rental properties available for a specific branch along with the managers name </h2>";
    	echo "<form action='branchNo.php' method='get'>";
	echo "Branch Number: <input type='text' name='branchNo'><br>";
	echo "<input type='submit'>";
	echo "</form>";

	echo "<h2> 2) Generate a list of supervisors and the properties they supervise </h2>";
	
	$sql = "SELECT employee.empId,employee.first_Name,employee.Last_Name,Rental_Property.rentalNo,Rental_Property.address_street,Rental_Property.address_city,rental_property.address_zip FROM employee INNER JOIN Rental_Property ON employee.empId = Rental_Property.empId ORDER BY employee.last_name";
	
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
		

	echo "</table>";
	echo "<br />";
	
	echo "<h2> 3) Generate a list of rental properties by a specific owner, listed in a Greenfield branch </h2>";
	echo "<form action='owner.php' method='get'>";
	echo "Owner Id: <input type='text' name='ownerId'><br>";
	echo "<input type='submit'>";
	echo "</form>";
		
	echo "<h2> 4) Show a list of properties available, where the properties should satisfy the criteria (city, noOfRooms, and or/range)</h2>";
	echo "<form action='criteriaSearch.php' method='get'>";
	echo "City: <input type='text' name='address_city'>";
	echo "Number of Rooms <input type='text' name='noOfRooms'> <br >";
	echo "Lowest Rent: <input type='number' name='lowRent'>";
	echo "Highest Rent: <input type='number' name='highRent'><br />";
	echo "<input type='submit'>";
	echo "</form>";

	echo "<h2> 5) Show the number of properties available for rent by branch </h5>";
	
	$sql = "SELECT Employee.branchNo, SUM(propertyCount) FROM Employee, (SELECT empId, COUNT(*) AS propertyCount FROM Rental_Property GROUP BY empId) sq WHERE sq.empId = Employee.empId GROUP BY Employee.branchNo";
        
	$sql_statement = OCIParse($conn, $sql);
        OCIExecute($sql_statement);
        $num_columns = OCINumCols($sql_statement);
        
	echo "<table border=1 class='table'>";
        echo "<tr><th> Branch No </th><th> Number of Available Properties </th></tr>";

      	while(OCIFetch($sql_statement)){
     		echo "<tr>";
              	for($i = 1; $i <= $num_columns; $i++){
     	   	        $column_value = OCiResult($sql_statement, $i);
          		echo "<td> $column_value </td>";
               	}
               
		echo "</tr>";
       	}
                

	echo "</table>";
        echo "<br />";
	
	readfile("footer.html");	

?>

