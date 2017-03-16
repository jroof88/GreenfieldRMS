/*
When a lease agreement is created, the status of the property should be changed
*/

SET SERVEROUTPUT ON;

CREATE OR REPLACE TRIGGER change_status_trig
	BEFORE INSERT ON Lease_Agreement
	FOR EACH ROW
DECLARE
	tempStatus Rental_Property.status%type;
BEGIN
	DBMS_OUTPUT.put_line('Change Status Trigger fired');
	SELECT status INTO tempStatus
	FROM Rental_Property
	WHERE rentalNo = :new.rentalNo;

	IF tempStatus = 'Leased' THEN
		RAISE_APPLICATION_ERROR(-2000, 'This property is already leased. Cannot generate lease agreement');
	ELSE
		UPDATE Rental_Property
		SET status = 'Leased'
		WHERE rentalNo = :new.rentalNo;
	END IF;
	--Obviously you can't lease a Rental_Property thats status is 'Leased' -> look into this
	
END;
/
SHOW ERRORS;
