CREATE OR REPLACE TRIGGER check_manager_trig
	BEFORE INSERT OR UPDATE ON Employee
	FOR EACH ROW
       	WHEN(new.jobDesignation = 'man')
DECLARE
	dum VARCHAR(30);
BEGIN
	DBMS_OUTPUT.PUT_LINE('check_manager_trig fired');
	SELECT empId INTO dum
	FROM Employee
	WHERE branchNo = :new.branchNo AND jobDesignation = 'man';
	IF SQL%FOUND THEN
		RAISE_APPLICATION_ERROR(-2000, 'Cannot add employee, branch already has a manager');
	END IF;
END;
/
SHOW ERRORS;

