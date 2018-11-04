/*CREATING THE TABLES*/

CREATE TABLE supplier
(
    id SERIAL PRIMARY KEY
    , companyName VARCHAR(20) NOT NULL
    , companyLogo VARCHAR(40) NOT NULL
);

CREATE TYPE cLevel AS ENUM ('1','2','3');
CREATE TABLE customer
(
    id SERIAL PRIMARY KEY
    , customerName VARCHAR(40) NOT NULL
    , email VARCHAR(50) NOT NULL    
    , userName VARCHAR(50)
    , password VARCHAR(255) NOT NULL
    , phoneNumber INT
    , clientLevel cLevel DEFAULT '1'
);

CREATE TABLE product
(
    id SERIAL PRIMARY KEY
    , productName VARCHAR(50) NOT NULL    
    , productImage VARCHAR(50) NOT NULL
    , model VARCHAR(30) NOT NULL
    , unitPrice NUMERIC (5, 2) NOT NULL
    , isFavorite BOOLEAN
    , fuelEfficiencyCity INT NOT NULL
    , fuelEfficiencyHighway INT NOT NULL
    , safety SMALLINT NOT NULL
    , mileage NUMERIC (8, 0) NOT NULL
    , supplier_id INT NOT NULL REFERENCES supplier(id)
);

CREATE TABLE orders
(
    id SERIAL PRIMARY KEY
    , orderNumber VARCHAR(10) NOT NULL
    , orderDate DATE
    , totalAmount INT NOT NULL
    , customer_id INT NOT NULL REFERENCES customer(id)
);

CREATE TABLE orderItem
(
    unitPrice NUMERIC (5, 2) NOT NULL
    , quantity INT NOT NULL
    , order_id INT NOT NULL REFERENCES orders(id)
    , product_id INT NOT NULL REFERENCES product(id)
);

/*INSERTING VALUES ON THE DB*/


INSERT INTO supplier (companyName, companyLogo) VALUES 
('Honda', '../images/honda.jpg'),
('Chevrolet', '../images/chevrolet.jpg'),
('Ford', '../images/ford.jpg'),
('Nissan', '../images/nissan.jpg'),
('Subaru', '../images/subaru.jpg'),
('Toyota', '../images/toyota.jpg');

INSERT INTO product (productName, productImage, model, unitPrice, isFavorite, fuelEfficiencyCity, fuelEfficiencyHighway, safety, mileage, supplier_id) VALUES 
('PHonda1', '../images/honda.jpg', 'CR-V-2018', 100.22, false, 28, 33, 3, 2000, 1),
('PHonda2', '../images/honda.jpg', 'CR-V-2018', 100.11, false, 38, 43, 2, 2040, 1),
('PChevrolet', '../images/chevrolet.jpg', 'VOLT-2017', 200.12, false, 40, 53, 4, 2000, 2),
('PFord', '../images/ford.jpg', 'FOCUS-2018', 100.21, false, 27, 30, 3, 2000, 3),
('PNissan', '../images/nissan.jpg', 'ROGUE-2017', 400.23, false, 29, 32, 5, 2000, 4),
('PSubaru', '../images/subaru.jpg', 'OUTBACK AWD-2018', 500.23, false, 28, 31, 4, 2000, 5),
('PToyota', '../images/toyota.jpg', 'COROLLA', 600.21, false, 29, 32, 3, 2000, 6),
('PChevrolet', '../images/chevrolet2.jpg', 'VOLT-2017', 200.12, false, 40, 53, 4, 2000, 2),
('PFord', '../images/ford2.jpg', 'FOCUS-2018', 100.21, false, 27, 30, 3, 2000, 3);






