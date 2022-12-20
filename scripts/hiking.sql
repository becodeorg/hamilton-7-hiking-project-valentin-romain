USE hiking;
DROP TABLE IF EXISTS hikes;
CREATE TABLE hikes (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(60) NOT NULL,
                       creation_date DATE NOT NULL,
                       distance FLOAT NOT NULL,
                       elevation_gain FLOAT NOT NULL,
                       description VARCHAR(1000) NOT NULL,
                       updated_at DATETIME NULL
);
DROP TABLE IF EXISTS users;
CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       first_name VARCHAR(60) NOT NULL,
                       last_name VARCHAR(60) NOT NULL,
                       nick_name VARCHAR(60) NOT NULL UNIQUE,
                       email VARCHAR(255) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL
);
DROP TABLE IF EXISTS tags;
CREATE TABLE tags (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      name VARCHAR(60) NOT NULL
);