-- Create database
CREATE DATABASE app_dev_login;

-- Use database
USE app_dev_login;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- store hashed passwords
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample user (password is 'password123')
INSERT INTO users (name, email, password) VALUES (
    'John Doe', 
    'john@example.com', 
    MD5('password123')
);