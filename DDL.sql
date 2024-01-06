CREATE DATABASE Car_Rental_System;
USE Car_Rental_System;

CREATE TABLE office (
    office_id INT AUTO_INCREMENT,
    location VARCHAR(40) NOT NULL,
    name VARCHAR(40) NOT NULL,
    phone_no VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR (64) UNIQUE NOT NULL,
    PRIMARY KEY(office_id)
);
CREATE TABLE car (
    plate_id VARCHAR(10),
    brand VARCHAR(40) NOT NULL,
    model VARCHAR(40) NOT NULL,
    year YEAR NOT NULL,
    pricePerDay INT NOT NULL,
    color VARCHAR(100) NOT NULL,
    miles INT NOT NULL,
    office_id INT NOT NULL,
    PRIMARY KEY(plate_id),
    FOREIGN KEY (office_id) REFERENCES office (office_id) ON DELETE CASCADE
);



CREATE TABLE user (
    ssn VARCHAR(20),
    fname VARCHAR(32) NOT NULL,
    lname VARCHAR(32) NOT NULL,
    email VARCHAR(64) UNIQUE NOT NULL,
    phone_no CHAR(11) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    isAdmin VARCHAR(100) not null,
    PRIMARY KEY (ssn)
);
    
CREATE TABLE reservation (
    reservation_id INT AUTO_INCREMENT,
    reserve_date DATE DEFAULT (CURRENT_DATE),
    pickup_date DATE NOT NULL,
    return_date DATE NOT NULL,
    ssn VARCHAR(20) NOT NULL,
    plate_id VARCHAR(20) NOT NULL,
    price float NOT NULL,
    PRIMARY KEY(reservation_id),
    FOREIGN KEY (plate_id) REFERENCES car (plate_id) ON DELETE CASCADE,
    FOREIGN KEY (ssn) REFERENCES user (ssn) ON DELETE CASCADE
);


CREATE TABLE out_of_service(
    plate_id VARCHAR(10) NOT NULL,
    startDate DATE,
    endDate DATE,
    FOREIGN KEY (plate_id) REFERENCES car (plate_id) ON DELETE CASCADE
);