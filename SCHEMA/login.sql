-- Create the database
CREATE DATABASE IF NOT EXISTS noise_monitoring_system;
USE noise_monitoring_system;

-- =========================
-- Users Table
-- =========================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,             -- store hashed passwords
    role ENUM('admin','manager','user') NOT NULL DEFAULT 'user',  -- role-based access
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Example users
INSERT INTO users (name,email,password,role) VALUES
('Admin User','admin@example.com','$2a$12$rDjT7OEUZlZDn4mhD9xY0.IcnUG/KLqU9dN2hYhLC0LmufY4R1CRa','admin'),
('Manager User','manager@example.com','$2a$12$f24z714RH8/qw55Izbf1.eX0nOSEWGXz2Csr.2uNDsMY9pJgozEKC','manager'),
('Regular User','user@example.com','$2a$12$ClrTIYKP2FMGDVaQcR9HAe6SZETU/rPvhTj/.g2J6e1DXYswC9g7u','user');

-- =========================
-- Classrooms / Rooms Table
-- =========================
CREATE TABLE IF NOT EXISTS classrooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    status ENUM('Normal','Warning','Critical') DEFAULT 'Normal',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Example rooms
INSERT INTO classrooms (name,status) VALUES
('Laboratory 1','Normal'),
('Laboratory 2','Normal'),
('Laboratory 3','Normal');

-- =========================
-- Alerts Table
-- =========================
CREATE TABLE IF NOT EXISTS alerts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classroom_id INT NOT NULL,
    db_level INT NOT NULL,
    severity ENUM('Normal','Warning','Critical') NOT NULL,
    alert_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (classroom_id) REFERENCES classrooms(id) ON DELETE CASCADE
);

-- =========================
-- Logs Table
-- =========================
CREATE TABLE IF NOT EXISTS user_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    log_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);