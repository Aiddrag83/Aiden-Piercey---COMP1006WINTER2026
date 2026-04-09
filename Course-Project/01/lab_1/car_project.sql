-- Car Project Database Setup
-- I didn't know you can make sql files through here, this is neat

CREATE DATABASE IF NOT EXISTS car_project;
USE car_project;

CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    make VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
