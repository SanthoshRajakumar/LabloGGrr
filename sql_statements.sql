CREATE TABLE People(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Ssn VARCHAR(13),
    FirstName VARCHAR(50),          
    LastName VARCHAR(50),           
    UserName VARCHAR(100),             
    Salt VARCHAR(3),
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

CREATE TABLE Access (
    PeopleID INT,
    RoleID INT,                              
    RoomID INT,
    FOREIGN KEY (PeopleID) REFERENCES People(ID),
    FOREIGN KEY (RoleID) REFERENCES Roles(ID),
    FOREIGN KEY (RoomID) REFERENCES Rooms(ID),
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

CREATE TABLE Location (
    ProductID INT,
    RoomID INT,
    Quantity INT,
    FOREIGN KEY (ProductID) REFERENCES Product(ID),
    FOREIGN KEY (RoomID) REFERENCES Rooms(ID),
    PRIMARY KEY (ProductID, RoomID)
);