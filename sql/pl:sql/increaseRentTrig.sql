/*
Increase Rent 10% when a new lease is made
*/

SET SERVEROUTPUT ON;

CREATE OR REPLACE TRIGGER increase_rent_trig
	AFTER INSERT ON Lease_Agreement
	FOR EACH ROW
BEGIN
	DBMS_OUTPUT.put_line('Incrase Rent Trigger fired');
	UPDATE Rental_Property
	SET monthlyRent = monthlyRent*1.10
	WHERE rentalNo = :new.rentalNo;
END;
/
SHOW ERRORS;
