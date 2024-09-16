CREATE TABLE People(
    Ssn VARCHAR(13) PRIMARY KEY,
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
    Ssn VARCHAR(13),
    RoleID INT,                              
    RoomID INT,
    CONSTRAINT PK_Access PRIMARY KEY (Ssn, RoleID, RoomID),                              
    CONSTRAINT FK_People
        FOREIGN KEY (Ssn) 
        REFERENCES People(Ssn),
    CONSTRAINT FK_Roles
        FOREIGN KEY (RoleID) 
        REFERENCES Roles(ID),
    CONSTRAINT FK_Rooms
        FOREIGN KEY (RoomID) 
        REFERENCES Rooms(ID)
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
    CONSTRAINT FK_ProductType
        FOREIGN KEY (ProductTypeID) 
        REFERENCES ProductType(ID)
);

CREATE TABLE Location (
    ProductID INT,
    RoomID INT,
    Quantity INT,
    CONSTRAINT PK_Location PRIMARY KEY (ProductID, RoomID),
    CONSTRAINT FK_Product
        FOREIGN KEY (ProductID) 
        REFERENCES Product(ID),
    CONSTRAINT FK_Rooms
        FOREIGN KEY (RoomID) 
        REFERENCES Rooms(ID)
)

