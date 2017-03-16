/* a) One manager per branch (GOOD) */
INSERT INTO Employee VALUES('e7', 'Jamie', 'Ronald', DATE '2012-02-12', 'man', 'b1');


/* b) When a lease agreement is created, the status for the property should be changed to leased (GOOD) */
-- Insert Lease into GUI, then click 'View Properties' from NavBar


/* c) Check to see that when a Rental Property is made that the empId is a supervisor and not a manager (GOOD) */
INSERT INTO Rental_Property VALUES('r6', '805 Weston Road', 'Santa Cruz', '11112', 6, 9000, DATE '2013-07-19', 'Available', 'o3', 'e1');


/* d) When a rental property is removed from the list of rentals, it should also be removed from its supervisor’s list(GOOD) */
DELETE FROM Rental_Property WHERE rentalNo = 'r5';
--Use GUI to check Supervisor List


/*With every new lease, a 10% increase iin rent should be added to the rent from the previous lease (GOOD)*/
SELECT rentalNo, monthlyRent FROM Rental_Property;
-- insert a lease into GUI, then select * FROM Rental_Property, check that the rent has increased by 10%
