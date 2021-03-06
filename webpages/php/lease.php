<?php
	
	readfile("header.html");
	include_once "connect.php";
	
	$leaseId = $_GET["leaseId"];
	$renterId = $_GET["rId"];
	$sql_ = "SELECT first_name, last_name, contactFirst_name, contactLast_name, homePhoneNo, workPhoneNo FROM Renter WHERE renterId = '$renterId'";
	$sql_statement_ = OCIParse($conn, $sql_);
	$y = 0;
	
	$renterFirst_name = NULL;
	$renterLast_name = NULL;
	$contactFirst_name = NULL;
	$contactLast_name = NULL;
	$homePhoneNo = NULL;
	$workPhoneNo = NULL;
	
	OCIExecute($sql_statement_);
	while(OCIFetch($sql_statement_)){
		$renterFirst_name = OCIResult($sql_statement_, 'FIRST_NAME');
		$renterLast_name = OCIResult($sql_statement_, 'LAST_NAME');
		$contactFirst_name = OCIResult($sql_statement_, 'CONTACTFIRST_NAME');
		$contactLast_name = OCiResult($sql_statement_, 'CONTACTLAST_NAME');
		$homePhoneNo = OCIResult($sql_statement_, 'HOMEPHONENO');
		$workPhoneNo = OCIResult($sql_statement_, 'WORKPHONENO');
		$y = 1;
	}
	if($y == 0){
		echo "This renter does not exist";
		exit;
	}	
	

	$start_date = ($_GET["start_date"]);
	$end_date = ($_GET["end_date"]);
	$start_date_ = date_create($start_date);
	$end_date_ = date_create($end_date);
	$diff = $end_date_->diff($start_date_);
	$days = $diff->format('%d');
	$rentalNo = $_GET["rentalNo"];

	$sql0 = "SELECT monthlyRent FROM Rental_Property WHERE '$rentalNo' = rentalNo";
	$sql_statement0 = OCIParse($conn, $sql0);
	OCIExecute($sql_statement0);
	$i = 0;
	while(OCIFetch($sql_statement0)){
		$rent = OCIResult($sql_statement0, 'MONTHLYRENT');
		if($days == '178' || '179' || '180' || '181' || '182'){
			$rent *= 1.1;
		}
		echo "<h3> The rent for $rentalNo is: $$rent";
		$i = 1;
	}
	if($i == 0){
		echo "<h3> Rental $rentalNo does not exist </h3>";
		exit;
	}
	
	$sqlName = "SELECT first_name, last_name FROM Employee WHERE empId IN (SELECT empId FROM Rental_Property WHERE rentalNo = '$rentalNo')";
	$sqlName_statement = OCIParse($conn, $sqlName);
	OCIExecute($sqlName_statement);
	$first_name = NULL;
	$last_name = NULL;
	while(OCIFetch($sqlName_statement)){
		$first_name = OCIResult($sqlName_statement, 'FIRST_NAME');
		$last_name = OCIResult($sqlName_statement, 'LAST_NAME');
	}
		
	$sql1 = "INSERT INTO Lease_Agreement VALUES('$leaseId', '$renterId', DATE '$start_date', DATE '$end_date', $rent, $rent, '$rentalNo')";
	$sql_statement1 = OCIParse($conn, $sql1);	
	if(!OCIExecute($sql_statement1)){
		echo "<h3> Lease agreement not created. Error with input values</h3>";
	}
	else{
		echo "<h3>Congratulations! Here is your lease agreement.</h3>";
		echo "Lease Id: $leaseId <br />";
		echo "First Name: $renterFirst_name <br />";
		echo "Last Name: $renterLast_name <br />";
		echo "Contact First Name: $contactFirst_name <br />";
		echo "Contact Last Name: $contactLast_name <br />";
		echo "Start Date: $start_date <br />";
		echo "End Date: $end_date <br />";
		echo "Monthly Rent Amount: $rent <br />";
		echo "Deposit: $rent <br />";
		echo "Rental Number: $rentalNo <br />";
		echo "The Supervisor is: $first_name $last_name <br />";
		echo "<h4> Thank you! </h4>";
	}

	echo "<h3><a href='/~jroof/GreenfieldRMS/createLease.php'>BACK</a></h3>";


	readfile("footer.html");

?>
