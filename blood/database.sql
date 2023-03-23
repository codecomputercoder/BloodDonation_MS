create database bms;
use bms;

CREATE TABLE users (
  id int NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  user_type enum('admin', 'donor') NOT NULL,
  PRIMARY KEY (id)
);

 INSERT INTO users (username, password, user_type) VALUES ('admin', 'admin_password', 'admin');

 INSERT INTO users (username, password, user_type) VALUES ('johndoe@example.com', 'John Doe', 'donor');
 
 CREATE TABLE donors (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    blood_group VARCHAR(10) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    last_donation_date DATE NOT NULL,
    PRIMARY KEY (id)
);



CREATE TABLE blood_donations (
id INT(11) NOT NULL AUTO_INCREMENT,
donor_id INT(11) NOT NULL,
donation_date DATE NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (donor_id) REFERENCES donors(id) ON DELETE CASCADE
);

