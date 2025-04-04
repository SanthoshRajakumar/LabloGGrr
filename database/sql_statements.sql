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
("Sara", "Mosebach", "sara_1022@hotmail.com", "admin", 1, "147952a34c7b7e426bc450658d11c7be", "138c5f39ebd0123cbf412abc7e4a971c"), #passw: 1234
("Gabriel", "Hedman Slottner", "gslottner@gmail.com", "gahe8576", 2, "9d48aa3b84a877928681c8b65411f4e6", "4c726be474dedb4c7f118a505624d7cf"), #passw: monkey
("Therese", "Björkman", "teppatopp@gmail.com", "thbj8259", 2, "ca8d15eeb1fc413d9986741be44d99ea", "ad46542588fdd04f95645879d6beaecf"), #passw: memory
("Santhosh", "Raja Kumar", "santhosh235200@gmail.com", "sara1634", 2, "44488b7e8afe2d500c9c74a95e53bbf5", "9605144d9c4ad33f30b8b6b6d47a4605"); #passw: lion

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
("Full access (Add, Delete, Edit, View)"),
("Partial access (Edit, View)"),
("Limited access (View)");

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