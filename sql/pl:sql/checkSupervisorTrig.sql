/*
checkSupervisorTrig -- Check to see if the Rental Property is made with a superivsor and not a manager
*/

SET SERVEROUTPUT ON;

CREATE OR REPLACE TRIGGER check_supervisor_trig
	BEFORE INSERT ON Rental_Property
	FOR EACH ROW
DECLARE
	jobDes Employee.empId%type;
BEGIN
	SELECT jobDesignation INTO jobDes
	FROM Employee
	WHERE empId = :new.empId;
	
	IF jobDes = 'man' THEN
		RAISE_APPLICATION_ERROR(-2000, 'The EmpId you entered is not a Supervisor');
	END IF;
	
END;
/
SHOW ERRORS; 
