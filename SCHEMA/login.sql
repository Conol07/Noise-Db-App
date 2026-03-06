  CREATE DATABASE classroom_noise_detection;
USE classroom_noise_detection;

-- USERS TABLE (for login)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(20) DEFAULT 'teacher',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- CLASSROOM TABLE
CREATE TABLE classrooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_name VARCHAR(50),
    building VARCHAR(100)
);

-- NOISE LOGS TABLE
CREATE TABLE noise_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classroom_id INT,
    noise_level INT,
    status VARCHAR(20),
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (classroom_id) REFERENCES classrooms(id)
);

-- ALERTS TABLE
CREATE TABLE alerts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classroom_id INT,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password, role)
VALUES ('Admin', 'admin@gmail.com', '123456', 'admin');

INSERT INTO classrooms (room_name, building)
VALUES ('Room 101', 'Main Building');

