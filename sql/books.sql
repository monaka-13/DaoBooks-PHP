-- DROP the database if it exists
-- CREATE THE DATABASE
DROP DATABASE IF EXISTS books;
CREATE DATABASE IF NOT EXISTS books;

-- Use the database
USE books;

-- Create Customer table
CREATE TABLE Customers
( CustomerID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name CHAR(50) NOT NULL,
  Address CHAR(100) not null,
  City CHAR(30) not null
) ENGINE=InnoDB;

-- Create Orders table
CREATE TABLE Orders
( OrderID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  CustomerID INT UNSIGNED NOT NULL,
  Amount FLOAT(6,2),
  Date DATE NOT NULL,

  FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Create Books table
CREATE TABLE Books
(  ISBN CHAR(13) NOT NULL PRIMARY KEY,
   Author CHAR(50),
   Title CHAR(100),
   Price FLOAT(4,2)
) ENGINE=InnoDB;

-- Create Order_Items.... an associative table
CREATE TABLE Order_Items
( OrderID INT UNSIGNED NOT NULL,
  ISBN CHAR(13) NOT NULL,
  Quantity TINYINT UNSIGNED,

  PRIMARY KEY (OrderID, ISBN),
  FOREIGN KEY (OrderID) REFERENCES Orders(OrderID) ON DELETE CASCADE,
  FOREIGN KEY (ISBN) REFERENCES Books(ISBN) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Create Book_Reviews table
CREATE TABLE Book_Reviews
(
  ISBN CHAR(13) NOT NULL PRIMARY KEY,
  Review TEXT,
 
  FOREIGN KEY (ISBN) REFERENCES Books(ISBN) ON DELETE CASCADE
) ENGINE=InnoDB;


-- INSERT Customers records
INSERT INTO Customers VALUES
  (1, 'Julie Smith', '25 Oak Street', 'Airport West'),
  (2, 'Alan Wong', '1/47 Haines Avenue', 'Box Hill'),
  (3, 'Michelle Arthur', '357 North Road', 'Yarraville');

-- INSERT Books records
INSERT INTO Books VALUES
  ('0-672-31697-8', 'Michael Morgan', 
   'Java 2 for Professional Developers', 34.99),
  ('0-672-31745-1', 'Thomas Down', 'Installing Debian GNU/Linux', 24.99),
  ('0-672-31509-2', 'Pruitt, et al.', 'Teach Yourself GIMP in 24 Hours', 24.99),
  ('0-672-31769-9', 'Thomas Schenk', 
   'Caldera OpenLinux System Administration Unleashed', 49.99);

-- INSERT Orders records
INSERT INTO Orders VALUES
  (NULL, 3, 69.98, '2007-04-02'),
  (NULL, 1, 49.99, '2007-04-15'),
  (NULL, 2, 74.98, '2007-04-19'),
  (NULL, 3, 24.99, '2007-05-01');

-- INSERT Order_Items records
INSERT INTO Order_Items VALUES
  (1, '0-672-31697-8', 2),
  (2, '0-672-31769-9', 1),
  (3, '0-672-31769-9', 1),
  (3, '0-672-31509-2', 1),
  (4, '0-672-31745-1', 3);

-- INSERT Book_Reviews records
INSERT INTO Book_Reviews VALUES
  ('0-672-31697-8', 'The Morgan book is clearly written and goes well beyond most of the basic Java books out there.'),
  ('0-672-31745-1', 'This book provides a very nice introduction on how to install Linux.'),
  ('0-672-31509-2', 'This book only teaches you the basic on using GIMP. You need other books to really do something worth with GIMP'),
  ('0-672-31769-9', 'The book covers all topics related to Linux Sysadmin. However, you can find more advance stuff in the internet nowadays');