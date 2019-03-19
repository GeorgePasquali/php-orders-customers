/*
CREATE TABLE employees (
employee_id int NOT NULL,
first_name varchar(25),
last_name  varchar(25),
department varchar(15),
email  varchar(50)
);

CREATE TABLE customers (
first_name varchar(25),
last_name  varchar(25),
assigned_employee employees,
email  varchar(50)
);
*/

CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100)
);
 
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    amount DOUBLE,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

CREATE USER 'jeffrey'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';