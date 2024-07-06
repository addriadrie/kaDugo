CREATE DATABASE dbKadugo;
USE dbKadugo;

-- CREATING OF TABLES --
CREATE TABLE tblAdmin(
	adminId INT IDENTITY(1,1) NOT NULL,
	adminName VARCHAR(255),
	adminPass VARCHAR(255)
);
CREATE TABLE tblBlood(
	groupId INT IDENTITY(1,1) NOT NULL, -- PRIMARY KEY
	bloodGroup VARCHAR(3)
);
CREATE TABLE tblDonor(
	groupId INT, -- FK to tblBlood
	donorId INT IDENTITY(1,1) NOT NULL, -- PK
	donorName VARCHAR(255),
	donorBirth DATE,
	donorSex VARCHAR(1),
	donorNum VARCHAR(11),
	donorEmail VARCHAR(255),
	donorAddress VARCHAR(255),
	donorMedical TEXT
);
CREATE TABLE tblPatient(
	groupId INT, -- FK to tblBlood
	patientId INT IDENTITY(1,1) NOT NULL, -- PK
	patientName VARCHAR(255),
	patientBirth DATE,
	patientSex VARCHAR(1),
	patientNum VARCHAR(11),
	patientEmail VARCHAR(255),
	patientAddress VARCHAR(255),
	patientMedical TEXT
);
CREATE TABLE tblInventory(
	bloodId INT IDENTITY(1,1) NOT NULL, -- PRIMARY KEY
	groupId INT, -- FK to tblBlood
	donorId INT, -- FK to tblDonor
	dateReceived DATE,
	patientId INT, -- FK to tblPatient
	dateDonated DATE
);
-- END OF CREATING THE TABLES -- 

-- CREATING PRIMARY KEYS --
ALTER TABLE tblAdmin ADD CONSTRAINT PK_adminId PRIMARY KEY (adminId);
ALTER TABLE tblBlood ADD CONSTRAINT PK_groupId PRIMARY KEY (groupId);
ALTER TABLE tblDonor ADD CONSTRAINT PK_donorId PRIMARY KEY (donorId);
ALTER TABLE tblPatient ADD CONSTRAINT PK_patientId PRIMARY KEY (patientId);
ALTER TABLE tblInventory ADD CONSTRAINT PK_bloodId PRIMARY KEY (bloodId);
-- END OF CREATING PRIMARY KEYS -- 

-- CREATING FOREIGN KEYS TO ESTABLISH CONNECTION --
ALTER TABLE tblDonor ADD CONSTRAINT FK_donorGrp FOREIGN KEY (groupId) REFERENCES tblBlood(groupId);
ALTER TABLE tblPatient ADD CONSTRAINT FK_patientGrp FOREIGN KEY (groupId) REFERENCES tblBlood(groupId);
ALTER TABLE tblInventory ADD CONSTRAINT FK_groupId FOREIGN KEY (groupId) REFERENCES tblBlood(groupId);
--ALTER TABLE tblInventory ADD CONSTRAINT FK_donorId FOREIGN KEY (donorId) REFERENCES tblDonor(donorId);
--ALTER TABLE tblInventory ADD CONSTRAINT FK_patientId FOREIGN KEY (patientId) REFERENCES tblPatient(patientId);
-- END OF CREATING FOREIGN KEYS -- 

-- INSERTING VALUES TABLES --
INSERT INTO tblAdmin(adminName, adminPass) VALUES ('admin', 'admin');

INSERT INTO tblBlood(bloodGroup) VALUES ('A+'), ('A-'), ('B+'), ('B-'), ('AB+'), ('AB-'), ('O+'), ('O-');

INSERT INTO tblDonor(groupId, donorName, donorBirth, donorSex, donorNum, donorEmail, donorAddress, donorMedical) VALUES
(7, 'Julianne Ramos', '2003-03-15', 'F', '09615213615', 'jramos@gmail.com', 'Imus City, Cavite', 'Physically Fit to Donate'),
(7, 'Adrielle Tarcena', '2002-11-10', 'F', '09123456789', 'atarcena@yahoo.com', 'Quezon City', 'Physically Fit to Donate'),
(7, 'Julius Villosillo', '2000-04-30', 'M', '09689614156', 'jvillosillo@gmail.com', 'Marikina City', 'Physically Fit to Donate'),
(1, 'Agustin Matias', '1995-06-04', 'M', '09744725427', 'amatias@gmail.com', 'Makati City', 'Physically Fit to Donate'),
(3, 'Mario Martin', '1997-10-16', 'M', '09564751243', 'mmartin@yahoo.com', 'Makati City', 'Physically Fit to Donate');

INSERT INTO tblPatient(groupId, patientName, patientBirth, patientSex, patientNum, patientEmail, patientAddress, patientMedical) VALUES
(7, 'Antonia Ibanez', '1996-06-30', 'M', '09438679710', 'aibanez@gmail.com', 'Caloocan City', 'Major blood loss from injury'),
(7, 'Lidia Ferrer', '1970-08-23', 'F', '09546222506', 'lferrer@yahoo.com', 'Quezon City', 'Major blood loss from surgery'),
(7, 'Nicolas Vargas', '1995-06-06', 'M', '09129347489', 'nvargas@gmail.com', 'Marikina City', 'Hemophilia');

INSERT INTO tblInventory(groupId, donorId, dateReceived, patientId, dateDonated) VALUES (7, 1, '2023-03-15', 1, '2023-03-30');
INSERT INTO tblInventory(groupId, donorId, dateReceived, patientId, dateDonated) VALUES (7, 2, '2023-03-15', 2, '2023-03-30');
INSERT INTO tblInventory(groupId, donorId, dateReceived, patientId, dateDonated) VALUES (7, 3, '2023-03-15', 3, '2023-03-30');
INSERT INTO tblInventory(groupId, donorId, dateReceived, patientId, dateDonated) VALUES (1, 4, '2023-03-15', NULL, NULL);
INSERT INTO tblInventory(groupId, donorId, dateReceived, patientId, dateDonated) VALUES (3, 5, '2023-03-15', NULL, NULL);
-- END OF INSERTING VALUES --