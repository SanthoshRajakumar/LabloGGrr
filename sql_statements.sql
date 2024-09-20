CREATE TABLE People(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Ssn VARCHAR(13),
    FirstName VARCHAR(50),          
    LastName VARCHAR(50),           
    UserName VARCHAR(100),             
    Salt VARCHAR(50),
    HashCode VARCHAR(50)
);

CREATE TABLE Roles(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    RoleType VARCHAR(50)
);

CREATE TABLE Rooms (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    RoomName VARCHAR(50)
);

CREATE TABLE AccessLevel (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    AccessLevel VARCHAR(50)
);

CREATE TABLE Access (
    PeopleID INT,
    RoleID INT,                              
    RoomID INT,
    AccessID INT,
    FOREIGN KEY (PeopleID) REFERENCES People(ID),
    FOREIGN KEY (RoleID) REFERENCES Roles(ID),
    FOREIGN KEY (RoomID) REFERENCES Rooms(ID),
    FOREIGN KEY (AccessID) REFERENCES AccessLevel(ID),
    PRIMARY KEY (PeopleID, RoleID, RoomID)
);

CREATE TABLE ProductType (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ProductType VARCHAR(100)
);

CREATE TABLE Product (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ProductName VARCHAR(100),
    Volume INT,
    Mass INT,
    Pieces INT,
    ProductTypeID INT,
    FOREIGN KEY (ProductTypeID) REFERENCES ProductType(ID)
);

CREATE TABLE ProductLocation (
    ProductID INT,
    RoomID INT,
    Quantity INT,
    FOREIGN KEY (ProductID) REFERENCES Product(ID),
    FOREIGN KEY (RoomID) REFERENCES Rooms(ID),
    PRIMARY KEY (ProductID, RoomID)
);

INSERT INTO People (Ssn, , FirstName, LastName, UserName, Salt, HashCode)
VALUES (199901011111, "Sara", "Mosebach", "admin", "IMS", "4bb4d75c49d41f7ea3522726c8db4d9d"), --passw: 1234
VALUES (200001012222, "Gabriel", "Hedman Slottner", "gabbe", "OST", "6ef10d23cb49358f279c1a686400d645"), --passw: monkey
VALUES (19981013333, "Therese", "Björkman", "teppatopp", "SALT", "fd03cca92aa12665f0ae8c521bc9ea29"), --passw: memory
VALUES (200001011111, "Elsa", "Rosenblad", "krams", "AROMAT", "7bf38f80d23952c0e0ec1d0d72626461"); --passw: tdb

INSERT INTO Roles (RoleType)
VALUES ("Admin"),
VALUES ("Teacher"),
VALUES ("Teacher Assistant"),
VALUES ("Student");

INSERT INTO Rooms (RoomName)
VALUES ("Room1"),
VALUES ("Room2"),
VALUES ("Room3"),
VALUES ("Room4");

INSERT INTO AccessLevel (AccessLevel)
VALUES ("Admin"),
VALUES ("Add"),
VALUES ("Edit"),
VALUES ("View");

INSERT INTO Access (PeopleID, RoleID, RoomID, AccessID)
VALUES(1,1,1,1),
VALUES(1,1,2,1),
VALUES(1,1,3,1),
VALUES(1,1,4,1),
VALUES(2,2,1,2),
VALUES(2,2,3,2),
VALUES(3,3,2,3),
VALUES(4,4,4,4);

INSERT INTO ProductType (ProductType)
VALUES("Liquid Chemical"),
VALUES("Solid Chemical"),
VALUES("Glassware"),
VALUES("Single-use Item"),
VALUES("Other");

INSERT INTO Product (ProductName, Volume, ProductTypeID)
VALUES("Hydrochloric Acid", 1000, 1),
VALUES("Sodium Hydroxide", 1000, 1);

INSERT INTO Product (ProductName, Mass, ProductTypeID)
VALUES("Sodium Chloride", 1000, 2),
VALUES("Copper Perchlorate", 1000, 2);

INSERT INTO Product (ProductName, Pieces, ProductTypeID)
VALUES("Nitrile Gloves", 100, 4),
VALUES("Pipette tip (1 μl)", 20, 4),
VALUES("Beaker (100 ml)", 1, 3),
VALUES("Stirring Rod", 1, 3),
VALUES("Titration Stand", 1, 5),
VALUES("Fire Extinguisher", 1, 5);

INSERT INTO ProductLocation (ProductID, RoomID, Quantity)
VALUES(1,1,10),
VALUES(2,2,6),
VALUES(3,1,2),
VALUES(4,2,3),
VALUES(5,1,4),
VALUES(6,2,5),
VALUES(7,1,2),
VALUES(8,2,1),
VALUES(9,1,1),
VALUES(10,2,2),
VALUES(1,3,10),
VALUES(2,4,6),
VALUES(3,3,2),
VALUES(4,4,3),
VALUES(5,3,4),
VALUES(6,4,5),
VALUES(7,3,2),
VALUES(8,4,1),
VALUES(9,3,1),
VALUES(10,4,2);