
	<?php
		readfile("header.html");
	include_once "connect.php";

        echo "<h2> 6) Create Lease Agreement </h2>";
	echo "<form action='lease.php' method='get'>";
        echo "Lease Id: <input type='text' name='leaseId'><br>";
	echo "Renter Id: <input type='text' name='rId'><br>";
        echo "Start Date: <input type='date' name='start_date'><br>";
        echo "End Date: <input type='date' name='end_date'><br>";
	echo "Rental No <input type='text' name='rentalNo'><br>";
	echo "<input type='submit'>";
        echo "</form>";
	echo "<h2> 7) Show a Renter his/her lease agreement </h2>";
	echo "<form action='showLease.php' method='get'>";
	echo "Renter Id: <input type='text' name='renterId'><br >";
	echo "<input type='submit'>";
	echo "</form>";
	

	readfile("footer.html");

?>
