CREATE TABLE Roles (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    RoleType VARCHAR(50)
);

CREATE TABLE People (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50),          
    LastName VARCHAR(50),
    Email VARCHAR(50),           
    UserName VARCHAR(50),             
    RoleID INT,
    Salt VARCHAR(50),
    HashCode VARCHAR(100),
    Active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (RoleID) REFERENCES Roles(ID)
);

CREATE UNIQUE INDEX ix_username
ON People (UserName);

CREATE UNIQUE INDEX ix_salt
ON People (Salt);

CREATE TABLE Rooms (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    RoomName VARCHAR(50),
    Active BOOLEAN DEFAULT TRUE
);

CREATE TABLE AccessLevel (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    AccessLevel VARCHAR(50)
);

CREATE TABLE Access (
    PeopleID INT,
    RoomID INT,
    AccessID INT,
    FOREIGN KEY (PeopleID) REFERENCES People(ID),
    FOREIGN KEY (RoomID) REFERENCES Rooms(ID),
    FOREIGN KEY (AccessID) REFERENCES AccessLevel(ID),
    PRIMARY KEY (PeopleID, RoomID)
);

CREATE TABLE StudentKey (
    ID VARCHAR(10) PRIMARY KEY,
    CreatorID INT,
    FOREIGN KEY (CreatorID) REFERENCES People(ID)
);

CREATE TABLE StudentAccess (
    RoomID INT,
    KeyID VARCHAR(10),
    AccessID INT DEFAULT 4,
    FOREIGN KEY (RoomID) REFERENCES Rooms(ID),
    FOREIGN KEY (KeyID) REFERENCES StudentKey(ID),
    FOREIGN KEY (AccessID) REFERENCES AccessLevel(ID),
    PRIMARY KEY (KeyID, RoomID)
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

CREATE TABLE Shelf (
    ID INT AUTO_INCREMENT UNIQUE,
    RoomID INT,
    Name VARCHAR(50),
    FOREIGN KEY (RoomID) REFERENCES Rooms(ID),
    PRIMARY KEY (RoomID, Name)
);

CREATE TABLE ProductLocation (
    ProductID INT,
    RoomID INT,
    Quantity INT,
    ShelfID INT,
    FOREIGN KEY (ShelfID) REFERENCES Shelf(ID),
    FOREIGN KEY (ProductID) REFERENCES Product(ID),
    FOREIGN KEY (RoomID) REFERENCES Rooms(ID),
    PRIMARY KEY (ProductID, RoomID, ShelfID)
);

INSERT INTO Roles (RoleType)
VALUES 
("Admin"),
("Teacher"),
("Teacher Assistant"),
("Student");

INSERT INTO People (FirstName, LastName, Email, UserName, RoleID, Salt, HashCode)
VALUES 
("Sara", "Mosebach", "sara_1022@hotmail.com", "admin", 1, "IMS", "4bb4d75c49d41f7ea3522726c8db4d9d"), #passw: 1234
("Gabriel", "Hedman Slottner", NULL, "gabbe", 2, "OST", "6ef10d23cb49358f279c1a686400d645"), #passw: monkey
("Therese", "Björkman", "teppatopp@gmail.com", "teppatopp", 3, "SALT", "fd03cca92aa12665f0ae8c521bc9ea29"), #passw: memory
("Elsa", "Rosenblad", NULL, "krams", 4, "AROMAT", "7bf38f80d23952c0e0ec1d0d72626461"); #passw: tdb

INSERT INTO Rooms (RoomName)
VALUES 
("Room1"),
("Room2"),
("Room3"),
("Room4");

INSERT INTO Shelf (RoomID, Name)
VALUES
(1, "Shelf 1"),
(1, "Shelf 2"),
(1, "Cabinet 1"),
(2, "Shelf 1"),
(2, "Cabinet 1"),
(2, "Cabinet 2"),
(3, "Refrigerator"),
(3, "Cabinet 1"),
(4, "Box in corner"),
(4, "Shelf 1");


INSERT INTO AccessLevel (AccessLevel)
VALUES 
("Admin"),
("Add"),
("Edit"),
("View");

INSERT INTO Access (PeopleID, RoomID, AccessID)
VALUES
(1,1,1),
(1,2,1),
(1,3,1),
(1,4,1),
(2,1,2),
(2,3,2),
(3,2,3),
(4,4,4);

INSERT INTO ProductType (ProductType)
VALUES
("Liquid Chemical"),
("Solid Chemical"),
("Glassware"),
("Single-use Item"),
("Other");

INSERT INTO Product (ProductName, Volume, ProductTypeID)
VALUES
("Hydrochloric Acid", 1000, 1),
("Sodium Hydroxide", 1000, 1);

INSERT INTO Product (ProductName, Mass, ProductTypeID)
VALUES
("Sodium Chloride", 1000, 2),
("Copper Perchlorate", 1000, 2);

INSERT INTO Product (ProductName, Pieces, ProductTypeID)
VALUES
("Nitrile Gloves", 100, 4),
("Pipette tip (1 μl)", 20, 4),
("Beaker (100 ml)", 1, 3),
("Stirring Rod", 1, 3),
("Titration Stand", 1, 5),
("Fire Extinguisher", 1, 5);

INSERT INTO ProductLocation (ProductID, RoomID, Quantity, ShelfID)
VALUES
(1,1,10,1),
(2,2,6,4),
(3,1,2,2),
(4,2,3,5),
(5,1,4,3),
(6,2,5,6),
(7,1,2,1),
(8,2,1,5),
(9,1,1,3),
(10,2,2,6),
(1,3,10,7),
(2,4,6,9),
(3,3,2,8),
(4,4,3,10),
(5,3,4,8),
(6,4,5,9),
(7,3,2,7),
(8,4,1,10),
(9,3,1,8),
(10,4,2,9);

INSERT INTO StudentKey (ID, CreatorID)
VALUES
('1234567891', 1);

INSERT INTO StudentAccess (RoomID, KeyID)
VALUES
(1, '1234567891'),
(3, '1234567891');