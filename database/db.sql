create database bookstore;

use bookstore;

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(255),
    address TEXT,
    bio TEXT,
    role ENUM('admin','user') DEFAULT 'user',
    is_verified TINYINT(1) DEFAULT 0,
    wallet DECIMAL(10,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE books (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lender_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255),
    genre VARCHAR(100),
    description TEXT,
    price DECIMAL(10,2) DEFAULT 0.00,
    status ENUM('available','rented','unavailable') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT fk_lender FOREIGN KEY (lender_id) REFERENCES users(id) ON DELETE CASCADE
);


INSERT INTO users (name, email, password, phone, address, bio, role, is_verified, wallet, created_at, updated_at) VALUES
('user1',  'u1@gmail.com',  '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000005', 'Dhaka', 'I am user1', 'user', 0, 0.00, NOW(), NOW()),
('admin',  'admin@gmail.com',  '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000005', 'Dhaka', 'I am admin', 'admin', 1, 0.00, NOW(), NOW());

INSERT INTO books 
(`title`, `author`, `isbn`, `description`, `genre`, `condition`, `image_path`, `rental_price_per_day`, `security_deposit`, `rental_duration_max_days`, `is_available`, `lender_id`, `status`, `created_at`, `updated_at`)
VALUES
('Fictional Tale', 'Author 1', '9781000000001', 'An amazing fiction story.', 'Fiction', 'excellent', NULL, 0.50, 30.00, 30, 1, 1, 'available', NOW(), NOW())


