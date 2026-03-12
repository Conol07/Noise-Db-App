
CREATE DATABASE app_dev_login;


USE app_dev_login;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- store ang possible hashed passwords 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- if wala diri try tanaw sa sql ang table naa didto password(password is 'password123')
INSERT INTO users (name, email, password) VALUES (
    'John Doe', 
    'john@example.com', 
    MD5('password123')
);