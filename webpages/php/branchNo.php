<?php
	readfile("header.html");
	include_once "connect.php";

	$branchNo = $_GET["branchNo"];
	
	$sql0 = "SELECT first_name, last_name FROM Employee WHERE jobDesignation = 'man' AND branchNo = '$branchNo'";
	$sql_statement0 = OCIParse($conn, $sql0);
	OCIExecute($sql_statement0);
	$firstN;
	$lastN;
	while(OCIFetch($sql_statement0)){
		$firstN = OCIResult($sql_statement0, 'FIRST_NAME');
		$lastN = OCIResult($sql_statement0, 'LAST_NAME'); 
	}

	
	$sql = "SELECT rentalNo, address_street, address_city, address_zip FROM Rental_Property WHERE empId IN (SELECT empId FROM Employee WHERE branchNo = '$branchNo' AND jobDesignation = 'sup') AND status = 'Available'";
	$sql_statement = OCIParse($conn, $sql);
	OCIExecute($sql_statement);
	$numCols = OCINumCols($sql_statement);
	$x = 0;
	echo "<h2> The Manager at $branchNo is $firstN $lastN. Here are the available properties:</h2>";
	echo "<br />";
	echo "<table border=1 class='table'>";
	echo "<tr><th> Rental Number </th><th> Street </th> <th> City </th> <th> Zip </th></tr>";
	while(OCIFetch($sql_statement)){
		echo "<tr>";
		for($i = 1; $i <= $numCols; $i++){
			$temp = OCIResult($sql_statement, $i);
			echo "<td> $temp </td>";
			$x = 1;
		}
		echo "</tr>";
	}
	
	echo "</table>";
	if($x == 0){
		echo "<h2> There are currenlty no properties at $branchNo </h2>";
	}

	echo "<h2><a href='/~jroof/GreenfieldRMS/search.php'>BACK</a></h2>";
					
	readfile("footer.html");
?>
