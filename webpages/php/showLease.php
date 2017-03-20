<?php
	readfile("header.html");
	include_once "connect.php";	

	$renterId = $_GET["renterId"];

	$sql_ = "SELECT first_name, last_name, contactFirst_name, contactLast_name, homePhoneNo, workPhoneNo FROM Renter WHERE renterId = '$renterId'";
        $sql_statement_ = OCIParse($conn, $sql_);
        $y = 0;
        $renterFirst_name = NULL;
        $renterLast_name = NULL;
        OCIExecute($sql_statement_);
        while(OCIFetch($sql_statement_)){
                $renterFirst_name = OCIResult($sql_statement_, 'FIRST_NAME');
                $renterLast_name = OCIResult($sql_statement_, 'LAST_NAME');
                $y = 1;
        }
        if($y == 0){
                echo "This renter does not exist";
                exit;
        }
	
	echo "<h2> $renterFirst_name $renterLast_name's (id: $renterId) leases: </h2><br >";
	
	$sql = "SELECT Lease_Agreement.renterId, Lease_Agreement.leaseId, Lease_Agreement.rentalNo, Lease_Agreement.start_date, Lease_Agreement.end_date, Lease_Agreement.deposit, Lease_Agreement.rentAmt, Employee.first_name, Employee.last_name FROM Lease_Agreement, Employee WHERE renterId = '$renterId' AND Employee.empId IN (SELECT empId FROM Rental_Property WHERE rentalNo = Lease_Agreement.rentalNo)";

	
	$sql_statement = OCIParse($conn, $sql);
	OCiExecute($sql_statement);
	$numcols = OCINumCols($sql_statement);

	echo "<table border=1 class='table'>";
	echo "<tr><th> Renter Id  </th> <th> Lease Id </th> <th> Rental No </th><th> Start Date </th> <th> End Date </th> <th> Deposit </th><th> Monthly Rent </th> <th> Sup First </th> <th> Sup Last </th></tr>";
	
	$x = 0;
	while(OCIFetch($sql_statement)){
		$x = 1;
		echo "<tr>";
		for($i = 1; $i <= $numcols; $i++){
			$temp = OCIResult($sql_statement, $i);
			echo "<td> $temp </td>";
		}
		echo "</tr>";
	}
	
	echo "</table>";
		
	echo "<h2><a href='/~jroof/GreenfieldRMS/createLease.php'>BACK</a></h2>";

	readfile("footer.html");
?>
