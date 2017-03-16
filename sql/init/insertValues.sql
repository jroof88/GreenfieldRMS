/*
Insert Dummy Values
*/


/* Branch Table */
INSERT INTO Branch VALUES('b1', '2362958275', '99 Bellomy Street', 'Santa Clara', '95050');
INSERT INTO Branch VALUES('b2', '1728554617', '1234 Lafayette Street', 'San Jose', '95051');
INSERT INTO Branch VALUES('b3', '7382617292', '1001 Rainbow Road', 'Palo Alto', '83726');

/* Employee Table */
INSERT INTO Employee VALUES('e1', 'Jack', 'Roof', DATE '2012-02-12', 'man', 'b1');
INSERT INTO Employee VALUES('e2', 'Sanjay', 'Tamizharasu', DATE '2013-06-27', 'man', 'b2');
INSERT INTO Employee VALUES('e3', 'John', 'Johnson', DATE '2015-01-10', 'sup', 'b1');
INSERT INTO Employee VALUES('e4', 'Jill', 'Jackson', DATE '2014-06-11', 'sup', 'b1');
INSERT INTO Employee VALUES('e5', 'Tom', 'Tooney', DATE '2012-12-11', 'sup', 'b2');
INSERT INTO Employee VALUES('e6', 'Cam', 'Camera', DATE '2012-09-22', 'sup', 'b2');
INSERT INTO Employee VALUES('e7', 'Lisa', 'Leftfield', DATE '2012-07-31', 'man', 'b3');
INSERT INTO Employee VALUES('e8', 'Ronald', 'Righty', DATE '2005-02-10', 'sup', 'b3');
INSERT INTO Employee VALUES('e9', 'Cam', 'Camera', DATE '2009-09-01', 'sup', 'b3');


/* Owner Table */
INSERT INTO Owner VALUES('o1', 'Nick', 'Houseman', '40 Poplar Street', 'Santa Clara', '95050', '9372881772');
INSERT INTO Owner VALUES('o2', 'Melanie', 'Housewomen', '21 Alviso Street', 'Sunnyvale', '95053', '8371638444');
INSERT INTO Owner VALUES('o3', 'Howard', 'Flooring', '7 Benton Street', 'Los Gatos', '95057', '7773829102');
INSERT INTO Owner VALUES('o4', 'Megan', 'Vagabond', '19 Fremont Blvd', 'Fremont', '63728', '2829103614');
INSERT INTO Owner VALUES('o5', 'Danielle', 'Beach', '10 Stanford Court', 'Palo Alto', '92715', '2617584921');
INSERT INTO Owner VALUES('o6', 'Jackson', 'Pollack', '5555 Potrero Hill', ' San Francisco', '27164', '0101019183');

/* Rental_Property Table */
INSERT INTO Rental_Property VALUES('r1', '44 Penny Lane', 'Santa Clara', '95050', 4, 4000, DATE '2014-07-23', 'Available', 'o1', 'e3');
INSERT INTO Rental_Property VALUES('r2', '33 Wrong Road', 'Milpitas', '95056', 6, 8000, DATE '2016-01-01', 'Available', 'o1', 'e3');
INSERT INTO Rental_Property VALUES('r3', '98 Southpark Avenue', 'Fremont', '97888', 9, 12000, DATE '2013-07-30', 'Available', 'o2', 'e4');
INSERT INTO Rental_Property VALUES('r4', '9999 Crop Circle', 'San Jose', '95051', 2, 4000, DATE '2012-11-11', 'Available', 'o2', 'e5');
INSERT INTO Rental_Property VALUES('r5', '606 Ride Road', 'Santa Cruz', '11111', 5, 9000, DATE '2013-08-19', 'Available', 'o3', 'e6');
INSERT INTO Rental_Property VALUES('r6', '5555 Coup Road', 'Palo Alto', '12343', '12', '10000', DATE '2013-12-02', 'Available', 'o1', 'e8');
INSERT INTO Rental_Property VALUES('r7', '67 Sanjay Drive', 'San Francisco', '83291', '2', '7500', DATE '2012-02-03', 'Available', 'o2', 'e8');
INSERT INTO Rental_Property VALUES('r8', '88 Jawn Drive', 'Santa Clara', '95050', '6', '6000', DATE '2011-02-12', 'Available', 'o4', 'e9');
INSERT INTO Rental_Property VALUES('r9', '1 Giants Drive', 'Burlingame', '28192', '7', '8000', DATE '2015-07-12', 'Available', 'o5', 'e3');
INSERT INTO Rental_Property VALUES('r10', '49 49ers Way', 'Santa Clara', '95050', '10', '12000', DATE '2016-12-12', 'Available', 'o6', 'e4');

/* Renter Table */
INSERT INTO Renter VALUES('rent1', 'Jack', 'Roof', 'Tim', 'Roof', '9384755767', '9685746352');
INSERT INTO Renter VALUES('rent2', 'Sanjay', 'Tarm', 'Father', 'Engh', '1827364958', '1234567890');
