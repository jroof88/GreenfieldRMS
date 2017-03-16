/*
Table Creation
*/

DROP TABLE Lease_Agreement;
DROP TABLE Renter;
DROP TABLE Rental_Property;
DROP TABLE Employee;
DROP TABLE Branch;
DROP TABLE Owner;

CREATE TABLE Branch (
	branchNo VARCHAR(5) PRIMARY KEY,
	phoneNo VARCHAR(10),
	address_street VARCHAR(30),
	address_city VARCHAR(30),
	address_zip VARCHAR(30)
);

CREATE TABLE Employee (
	empID VARCHAR(5) PRIMARY KEY,
	first_name VARCHAR(25),
	last_name VARCHAR(25),
	startDate DATE,
	jobDesignation VARCHAR(25) CHECK(jobDesignation IN ('sup', 'man')),
	branchNo VARCHAR(5),
	FOREIGN KEY (branchNo) REFERENCES Branch(branchNo)
);

CREATE TABLE Owner (
	ownerId VARCHAR(5) PRIMARY KEY,
	first_name VARCHAR(25),
	last_name VARCHAR(25),
	address_street VARCHAR(30),
	address_city VARCHAR(30),
	address_zip VARCHAR(30),
	phoneNo VARCHAR(10)
);

CREATE TABLE Rental_Property (
	rentalNo VARCHAR(5) PRIMARY KEY,
	address_street VARCHAR(30),
	address_city VARCHAR(30),
	address_zip VARCHAR(30),
	noOfRooms NUMBER,
	monthlyRent NUMBER,
	startDate DATE,
	status VARCHAR(10) CHECK(status IN ('Available', 'Leased')),
	ownerId VARCHAR(5),
	empId VARCHAR(5),
	FOREIGN KEY (ownerId) REFERENCES Owner(ownerId),
	FOREIGN KEY (empId) REFERENCES Employee(empId) 	
);

CREATE TABLE Renter (
	renterId VARCHAR(5) PRIMARY KEY,
	first_name VARCHAR(25),
	last_name VARCHAR(25),
	contactFirst_name VARCHAR(25),
	contactLast_name VARCHAR(25),
	homePhoneNo VARCHAR(25),
	workPhoneNo VARCHAR(25)
);
	
CREATE TABLE Lease_Agreement (
	leaseId VARCHAR(5) PRIMARY KEY,
	renterId VARCHAR(5),
	start_date DATE,
	end_date DATE,
	deposit NUMBER,
	rentAmt NUMBER,
	rentalNo VARCHAR(5),
	FOREIGN KEY (renterId) REFERENCES Renter(renterId),
	FOREIGN KEY (rentalNo) REFERENCES Rental_Property(rentalNo),
	CONSTRAINT validLeaseLength CHECK(((end_date-start_date) >= 180)AND((end_date-start_date) <= 360))
);
