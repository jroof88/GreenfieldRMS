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
	branchNo VARCHAR(5) PRIMARY KEY NOT NULL,
	phoneNo VARCHAR(10) NOT NULL,
	address_street VARCHAR(30) NOT NULL,
	address_city VARCHAR(30) NOT NULL,
	address_zip VARCHAR(30) NOT NULL
);

CREATE TABLE Employee (
	empID VARCHAR(5) PRIMARY KEY NOT NULL,
	first_name VARCHAR(25) NOT NULL,
	last_name VARCHAR(25) NOT NULL,
	startDate DATE NOT NULL,
	jobDesignation VARCHAR(25) CHECK(jobDesignation IN ('sup', 'man')) NOT NULL,
	branchNo VARCHAR(5) NOT NULL,
	FOREIGN KEY (branchNo) REFERENCES Branch(branchNo)
);

CREATE TABLE Owner (
	ownerId VARCHAR(5) PRIMARY KEY NOT NULL,
	first_name VARCHAR(25) NOT NULL,
	last_name VARCHAR(25) NOT NULL,
	address_street VARCHAR(30) NOT NULL,
	address_city VARCHAR(30) NOT NULL,
	address_zip VARCHAR(30) NOT NULL,
	phoneNo VARCHAR(10) NOT NULL
);

CREATE TABLE Rental_Property (
	rentalNo VARCHAR(5) PRIMARY KEY NOT NULL,
	address_street VARCHAR(30) NOT NULL,
	address_city VARCHAR(30) NOT NULL,
	address_zip VARCHAR(30) NOT NULL,
	noOfRooms NUMBER NOT NULL,
	monthlyRent NUMBER NOT NULL,
	startDate DATE NOT NULL,
	status VARCHAR(10) CHECK(status IN ('Available', 'Leased')) NOT NULL,
	ownerId VARCHAR(5) NOT NULL,
	empId VARCHAR(5) NOT NULL,
	FOREIGN KEY (ownerId) REFERENCES Owner(ownerId),
	FOREIGN KEY (empId) REFERENCES Employee(empId) 	
);

CREATE TABLE Renter (
	renterId VARCHAR(5) PRIMARY KEY NOT NULL,
	first_name VARCHAR(25) NOT NULL,
	last_name VARCHAR(25) NOT NULL,
	contactFirst_name VARCHAR(25) NOT NULL,
	contactLast_name VARCHAR(25) NOT NULL,
	homePhoneNo VARCHAR(25) NOT NULL,
	workPhoneNo VARCHAR(25) NOT NULL
);
	
CREATE TABLE Lease_Agreement (
	leaseId VARCHAR(5) PRIMARY KEY NOT NULL,
	renterId VARCHAR(5) NOT NULL,
	start_date DATE NOT NULL,
	end_date DATE NOT NULL,
	deposit NUMBER NOT NULL,
	rentAmt NUMBER NOT NULL,
	rentalNo VARCHAR(5) NOT NULL,
	FOREIGN KEY (renterId) REFERENCES Renter(renterId),
	FOREIGN KEY (rentalNo) REFERENCES Rental_Property(rentalNo),
	CONSTRAINT validLeaseLength CHECK(((end_date-start_date) >= 180)AND((end_date-start_date) <= 360))
);
