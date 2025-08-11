-- Book Rental Platform Database Schema
-- MySQL

CREATE DATABASE book_rental_platform;
USE book_rental_platform;

-- Users Table
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    bio TEXT,
    role ENUM('admin', 'user') DEFAULT 'user',
    is_verified BOOLEAN DEFAULT FALSE,
    wallet DECIMAL(10,2) DEFAULT 0.00,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Password Reset Tokens Table
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL
);

-- Books Table
CREATE TABLE books (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    isbn VARCHAR(50),
    description TEXT,
    genre VARCHAR(100) NOT NULL,
    condition VARCHAR(20) DEFAULT 'good',
    image_path VARCHAR(255),
    rental_price_per_day DECIMAL(8,2) NOT NULL,
    security_deposit DECIMAL(8,2) DEFAULT 0,
    rental_duration_max_days INT DEFAULT 30,
    is_available BOOLEAN DEFAULT TRUE,
    lender_id BIGINT UNSIGNED NOT NULL,
    status ENUM('available', 'rented', 'maintenance', 'unavailable') DEFAULT 'available',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (lender_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Rentals Table
CREATE TABLE rentals (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    book_id BIGINT UNSIGNED NOT NULL,
    borrower_id BIGINT UNSIGNED NOT NULL,
    lender_id BIGINT UNSIGNED NOT NULL,
    rental_start_date DATE NOT NULL,
    rental_end_date DATE NOT NULL,
    actual_return_date DATE,
    daily_rate DECIMAL(8,2) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    security_deposit DECIMAL(10,2) DEFAULT 0,
    status ENUM('pending', 'active', 'completed', 'overdue', 'cancelled') DEFAULT 'pending',
    notes TEXT,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (borrower_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (lender_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Sample Inserts
-- INSERT INTO users (name, email, password, role, is_verified, wallet) VALUES
-- ('Admin User', 'admin@gmail.com', 'hashed_password', 'admin', TRUE, 100.00),
-- ('John Doe', 'john@gmail.com', 'hashed_password', 'user', FALSE, 50.00);

INSERT INTO books (title, author, genre, rental_price_per_day, lender_id, status) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', 'Classic', 5.00, 1, 'available'),
('1984', 'George Orwell', 'Dystopian', 4.00, 1, 'available');

INSERT INTO rentals (book_id, borrower_id, lender_id, rental_start_date, rental_end_date, daily_rate, total_amount, status)
VALUES (1, 2, 1, '2025-08-01', '2025-08-10', 5.00, 50.00, 'active');
