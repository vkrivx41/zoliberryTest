CREATE DATABASE IF NOT EXISTS zoliberry;


USE zoliberry;


CREATE TABLE IF NOT EXISTS Manager(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS ManagerDemographics(
    id INT AUTO_INCREMENT PRIMARY KEY,
    manager INT,
    phone VARCHAR(20) NOT NULL UNIQUE,
    image VARCHAR(300) NOT NULL UNIQUE,
    CONSTRAINT FOREIGN KEY (manager) REFERENCES Manager(id) ON DELETE SET NULL ON UPDATE CASCADE
); 


CREATE TABLE IF NOT EXISTS Author(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    twitter VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(100) DEFAULT 'No email',
    image VARCHAR(100) DEFAULT '',
    phone VARCHAR(20) DEFAULT 'No phone'
);

CREATE TABLE IF NOT EXISTS Moderator(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    twitter VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(100) DEFAULT 'No email',
    image VARCHAR(100) DEFAULT '',
    phone VARCHAR(20) DEFAULT 'No phone'
);




CREATE TABLE IF NOT EXISTS Article(
    id INT AUTO_INCREMENT PRIMARY KEY,
    tag VARCHAR(30) NOT NULL,
    title VARCHAR(1000) NOT NULL,
    one_text TEXT NOT NULL,
    two_text TEXT,
    three_text TEXT,
    four_text TEXT,
    five_text TEXT,
    author VARCHAR(100) NOT NULL,
    created_at DATE DEFAULT NOW(),
    views INT DEFAULT 0,
    one_image VARCHAR(100) DEFAULT '',
    two_image VARCHAR(100) DEFAULT '',
    three_image VARCHAR(100) DEFAULT '',
    four_image VARCHAR(100) DEFAULT '',
    five_image VARCHAR(100) DEFAULT ''
);


CREATE OR REPLACE VIEW dashboard AS
SELECT man.username, man.email, demo.phone, demo.manager as `twitter`
FROM manager man
INNER JOIN ManagerDemographics demo ON demo.manager = man.id
UNION
SELECT username, email, phone, twitter
FROM Author
UNION
SELECT username, email, phone, twitter
FROM Moderator;


CREATE TABLE IF NOT EXISTS Messages(
	id INT AUTO_INCREMENT primary key,
    sent DATE DEFAULT NOW(),
    sender_email VARCHAR(100) NOT NULL,
    sender_telephone VARCHAR(100) NOT NULL,
    sender_name VARCHAR(100) NOT NULL,
    body VARCHAR(1000) NOT NULL
);


CREATE TABLE IF NOT EXISTS Users(
	id INT auto_increment primary key,
    created_at DATETIME DEFAULT now(),
    theme VARCHAR(10) NOT NULL DEFAULT "White"
);


