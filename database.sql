-- Drop existing database and recreate it
DROP DATABASE IF EXISTS annonce;
CREATE DATABASE annonce;
USE annonce;

-- Create users table
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mail VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create announcements table
CREATE TABLE annonce (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    agence VARCHAR(50),
    type_bien VARCHAR(50),
    pieces INT,
    surface DECIMAL(10,2),
    prix DECIMAL(10,2),
    description TEXT,
    adresse VARCHAR(255),
    ville VARCHAR(100),
    code_postal VARCHAR(5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert database admin user with plain password
INSERT INTO utilisateurs (mail, password, role) VALUES
('admin@imoweb.com', 'admin123', 'admin');
