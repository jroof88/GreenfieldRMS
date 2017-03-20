<?php
	readfile("header.html");
	include_once "connect.php";
	
	$branchNo = $_GET["branchNo"];
	$sql = "SELECT Employee.branchNo,Rental_Property.rentalNo,Rental_Property.address_street,Rental_Property.address_city,rental_property.address_zip FROM Employee INNER JOIN Rental_Property ON Employee.branchNo = '$branchNo' AND Employee.empId = Rental_Property.empId";
	
	$sql_statement = OCIParse($conn, $sql);
        OCIExecute($sql_statement);
        $num_columns = OCINumCols($sql_statement);
        
	echo "<h1> List of Properties at Branch $branchNo: </h1>";
	echo "<table border=1 class='table'>";
        echo "<tr><th>Branch No</th><th> Rental Number </th><th> Street </th> <th> City </th> <th> Zip </th></tr>";

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

	echo "<h3> <a href='/~jroof/GreenfieldRMS/search.php'> BACK </a></h3>";
	readfile("footer.html");

?>
