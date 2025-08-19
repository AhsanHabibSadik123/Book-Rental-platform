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
    is_verified BOOLEAN DEFAULT FALSE,create database bookstore;
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



select * from books;
select * from users;

INSERT INTO users (name, email, password, phone, address, bio, role, is_verified, wallet, created_at, updated_at) VALUES
('user5',  'u5@gmail.com',  '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000005', 'Dhaka', 'I am user5', 'user', 0, 0.00, NOW(), NOW()),
('user6',  'u6@gmail.com',  '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000006', 'Chittagong', 'I am user6', 'user', 0, 0.00, NOW(), NOW()),
('user7',  'u7@gmail.com',  '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000007', 'Sylhet', 'I am user7', 'user', 0, 0.00, NOW(), NOW()),
('user8',  'u8@gmail.com',  '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000008', 'Khulna', 'I am user8', 'user', 0, 0.00, NOW(), NOW()),
('user9',  'u9@gmail.com',  '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000009', 'Rajshahi', 'I am user9', 'user', 0, 0.00, NOW(), NOW()),
('user10', 'u10@gmail.com', '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000010', 'Barishal', 'I am user10', 'user', 0, 0.00, NOW(), NOW()),
('user11', 'u11@gmail.com', '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000011', 'Rangpur', 'I am user11', 'user', 0, 0.00, NOW(), NOW()),
('user12', 'u12@gmail.com', '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000012', 'Mymensingh', 'I am user12', 'user', 0, 0.00, NOW(), NOW()),
('user13', 'u13@gmail.com', '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000013', 'Comilla', 'I am user13', 'user', 0, 0.00, NOW(), NOW()),
('user14', 'u14@gmail.com', '$2y$12$Qr4NERgAEtxPuA8N96rEbu3iS0Lgm4/e.7kWp3NuwenmiFy2JVR8a', '01710000014', 'Gazipur', 'I am user14', 'user', 0, 0.00, NOW(), NOW());



INSERT INTO books 
(`title`, `author`, `isbn`, `description`, `genre`, `condition`, `image_path`, `rental_price_per_day`, `security_deposit`, `rental_duration_max_days`, `is_available`, `lender_id`, `status`, `created_at`, `updated_at`)
VALUES
('Fictional Tale', 'Author 1', '9781000000001', 'An amazing fiction story.', 'Fiction', 'excellent', NULL, 0.50, 30.00, 30, 1, 1, 'available', NOW(), NOW()),
('Mystery Night', 'Author 2', '9781000000002', 'A thrilling mystery novel.', 'Mystery', 'very_good', NULL, 0.60, 40.00, 35, 1, 2, 'available', NOW(), NOW()),
('Science Guide', 'Author 3', '9781000000003', 'Educational guide for beginners.', 'Educational', 'good', NULL, 0.70, 50.00, 40, 1, 3, 'available', NOW(), NOW()),
('Romantic Escape', 'Author 4', '9781000000004', 'A heartwarming romance.', 'Romance', 'fair', NULL, 0.55, 35.00, 30, 1, 4, 'available', NOW(), NOW()),
('Fantasy World', 'Author 5', '9781000000005', 'Explore a magical fantasy world.', 'Fantasy', 'very_good', NULL, 0.80, 45.00, 45, 1, 5, 'available', NOW(), NOW()),
('Ocean Adventure', 'Author 8', '9781000000006', 'A thrilling ocean journey.', 'Fiction', 'excellent', NULL, 0.65, 40.00, 30, 1, 8, 'available', NOW(), NOW()),
('Mystery Manor', 'Author 9', '9781000000007', 'Solve the secrets of the manor.', 'Mystery', 'good', NULL, 0.70, 50.00, 35, 1, 9, 'available', NOW(), NOW()),
('Python Basics', 'Author 10', '9781000000008', 'Learn Python programming.', 'Educational', 'very_good', NULL, 0.60, 45.00, 40, 1, 10, 'available', NOW(), NOW()),
('Love in Paris', 'Author 11', '9781000000009', 'A romantic story in Paris.', 'Romance', 'excellent', NULL, 0.55, 35.00, 30, 1, 11, 'available', NOW(), NOW()),
('Space Journey', 'Author 12', '9781000000010', 'A science fiction adventure.', 'Science Fiction', 'good', NULL, 0.75, 50.00, 40, 1, 12, 'available', NOW(), NOW()),
('Dragon Realm', 'Author 13', '9781000000011', 'Epic fantasy battles.', 'Fantasy', 'very_good', NULL, 0.85, 60.00, 45, 1, 13, 'available', NOW(), NOW()),
('Fictional Saga', 'Author 14', '9781000000012', 'A saga of fictional heroes.', 'Fiction', 'good', NULL, 0.50, 30.00, 30, 1, 14, 'available', NOW(), NOW()),
('Mystery Island', 'Author 15', '9781000000013', 'Uncover mysteries on the island.', 'Mystery', 'fair', NULL, 0.65, 40.00, 35, 1, 15, 'available', NOW(), NOW()),
('EduTech Guide', 'Author 16', '9781000000014', 'Educational technology guide.', 'Educational', 'excellent', NULL, 0.70, 50.00, 40, 1, 16, 'available', NOW(), NOW()),
('Romantic Novel', 'Author 17', '9781000000015', 'Romantic adventures.', 'Romance', 'very_good', NULL, 0.55, 35.00, 30, 1, 17, 'available', NOW(), NOW()),
('Space Odyssey', 'Author 18', '9781000000016', 'Sci-fi journey through space.', 'Science Fiction', 'excellent', NULL, 0.80, 60.00, 45, 1, 18, 'available', NOW(), NOW()),
('Fantasy Tales', 'Author 1', '9781000000017', 'Magical fantasy stories.', 'Fantasy', 'good', NULL, 0.75, 50.00, 40, 1, 1, 'available', NOW(), NOW()),
('Fiction Chronicles', 'Author 2', '9781000000018', 'Chronicles of fictional events.', 'Fiction', 'very_good', NULL, 0.60, 40.00, 35, 1, 2, 'available', NOW(), NOW()),
('Mystery Secrets', 'Author 3', '9781000000019', 'Secrets of the unknown.', 'Mystery', 'excellent', NULL, 0.70, 45.00, 40, 1, 3, 'available', NOW(), NOW()),
('EduWorld', 'Author 4', '9781000000020', 'Education for everyone.', 'Educational', 'good', NULL, 0.65, 50.00, 35, 1, 4, 'available', NOW(), NOW()),
('Book 1', 'Author 1', '9780000000001', 'Nice story', 'Fiction', 'fair', NULL, 0.30, 70.00, 30, 1, 5, 'available', NOW(), NOW()),
('Book 2', 'Author 2', '9780000000002', 'Mystery thriller', 'Mystery', 'very_good', NULL, 0.50, 50.00, 30, 1, 5, 'available', NOW(), NOW()),
('Book 3', 'Author 3', '9780000000003', 'Educational content', 'Educational', 'good', NULL, 0.40, 40.00, 45, 1, 5, 'available', NOW(), NOW()),
('Book 4', 'Author 4', '9780000000004', 'Romantic novel', 'Romance', 'excellent', NULL, 0.60, 35.00, 30, 1, 5, 'available', NOW(), NOW()),
('Book 5', 'Author 5', '9780000000005', 'Fantasy adventure', 'Fantasy', 'very_good', NULL, 0.70, 50.00, 40, 1, 5, 'available', NOW(), NOW()),
('Book 6', 'Author 6', '9780000000006', 'Sci-fi journey', 'Science Fiction', 'good', NULL, 0.80, 60.00, 35, 1, 5, 'available', NOW(), NOW()),
('Book 7', 'Author 7', '9780000000007', 'Another mystery', 'Mystery', 'fair', NULL, 0.55, 45.00, 30, 1, 5, 'available', NOW(), NOW()),
('Book 8', 'Author 8', '9780000000008', 'Fictional story', 'Fiction', 'excellent', NULL, 0.90, 50.00, 50, 1, 5, 'available', NOW(), NOW()),
('Book 9', 'Author 9', '9780000000009', 'Romantic tale', 'Romance', 'good', NULL, 0.35, 30.00, 30, 1, 5, 'available', NOW(), NOW()),
('Book 10', 'Author 10', '9780000000010', 'Educational guide', 'Educational', 'very_good', NULL, 0.65, 55.00, 45, 1, 5, 'available', NOW(), NOW()),
('Book 11', 'Author 11', '9780000000011', 'Fantasy epic', 'Fantasy', 'excellent', NULL, 1.00, 70.00, 60, 1, 5, 'available', NOW(), NOW()),
('Book 12', 'Author 12', '9780000000012', 'Science fiction story', 'Science Fiction', 'very_good', NULL, 1.20, 60.00, 40, 1, 5, 'available', NOW(), NOW()),
('Book 13', 'Author 13', '9780000000013', 'Fiction drama', 'Fiction', 'good', NULL, 0.45, 35.00, 30, 1, 5, 'available', NOW(), NOW()),
('Book 14', 'Author 14', '9780000000014', 'Mystery tale', 'Mystery', 'fair', NULL, 0.50, 40.00, 30, 1, 5, 'available', NOW(), NOW()),
('Book 15', 'Author 15', '9780000000015', 'Educational material', 'Educational', 'excellent', NULL, 0.75, 50.00, 50, 1, 5, 'available', NOW(), NOW()),
('Book 16', 'Author 16', '9780000000016', 'Romance novel', 'Romance', 'very_good', NULL, 0.60, 45.00, 35, 1, 5, 'available', NOW(), NOW()),
('Book 17', 'Author 17', '9780000000017', 'Fantasy story', 'Fantasy', 'good', NULL, 0.70, 50.00, 40, 1, 5, 'available', NOW(), NOW()),
('Book 18', 'Author 18', '9780000000018', 'Sci-fi adventure', 'Science Fiction', 'excellent', NULL, 0.85, 60.00, 50, 1, 5, 'available', NOW(), NOW()),
('Book 19', 'Author 19', '9780000000019', 'Fiction saga', 'Fiction', 'very_good', NULL, 0.55, 45.00, 30, 1, 5, 'available', NOW(), NOW()),
('Book 20', 'Author 20', '9780000000020', 'Mystery novel', 'Mystery', 'good', NULL, 0.65, 50.00, 35, 1, 5, 'available', NOW(), NOW()),
('Non-Fiction 1', 'Author 5', '9782000000001', 'Insightful non-fiction book.', 'Non-Fiction', 'good', NULL, 0.50, 40.00, 30, 1, 5, 'available', NOW(), NOW()),
('Fiction 2', 'Author 8', '9782000000002', 'A thrilling fiction story.', 'Fiction', 'excellent', NULL, 0.60, 50.00, 35, 1, 8, 'available', NOW(), NOW()),
('Mystery 3', 'Author 9', '9782000000003', 'Uncover hidden secrets.', 'Mystery', 'very_good', NULL, 0.55, 35.00, 30, 1, 9, 'available', NOW(), NOW()),
('Romance 4', 'Author 10', '9782000000004', 'Romantic tales for everyone.', 'Romance', 'fair', NULL, 0.45, 30.00, 25, 1, 10, 'available', NOW(), NOW()),
('Science Fiction 5', 'Author 11', '9782000000005', 'Explore the universe.', 'Science Fiction', 'excellent', NULL, 0.70, 60.00, 40, 1, 11, 'available', NOW(), NOW()),
('Fantasy 6', 'Author 12', '9782000000006', 'Magical adventures await.', 'Fantasy', 'good', NULL, 0.65, 45.00, 35, 1, 12, 'available', NOW(), NOW()),
('Educational 7', 'Author 13', '9782000000007', 'Learn new skills.', 'Educational', 'very_good', NULL, 0.60, 50.00, 30, 1, 13, 'available', NOW(), NOW()),
('Other 8', 'Author 14', '9782000000008', 'Miscellaneous topics.', 'Other', 'fair', NULL, 0.50, 35.00, 25, 1, 14, 'available', NOW(), NOW()),
('Fiction 9', 'Author 15', '9782000000009', 'Exciting adventures.', 'Fiction', 'excellent', NULL, 0.75, 60.00, 40, 1, 15, 'available', NOW(), NOW()),
('Non-Fiction 10', 'Author 16', '9782000000010', 'Educational insights.', 'Non-Fiction', 'good', NULL, 0.55, 45.00, 30, 1, 16, 'available', NOW(), NOW()),
('Mystery 11', 'Author 17', '9782000000011', 'A puzzling mystery.', 'Mystery', 'very_good', NULL, 0.60, 50.00, 35, 1, 17, 'available', NOW(), NOW()),
('Romance 12', 'Author 18', '9782000000012', 'Romantic story set abroad.', 'Romance', 'excellent', NULL, 0.70, 55.00, 40, 1, 18, 'available', NOW(), NOW()),
('Science Fiction 13', 'Author 1', '9782000000013', 'Futuristic adventures.', 'Science Fiction', 'good', NULL, 0.65, 45.00, 35, 1, 1, 'available', NOW(), NOW()),
('Fantasy 14', 'Author 2', '9782000000014', 'Epic fantasy saga.', 'Fantasy', 'very_good', NULL, 0.60, 50.00, 30, 1, 2, 'available', NOW(), NOW()),
('Educational 15', 'Author 3', '9782000000015', 'Learn new concepts.', 'Educational', 'fair', NULL, 0.50, 40.00, 25, 1, 3, 'available', NOW(), NOW()),
('Other 16', 'Author 4', '9782000000016', 'Miscellaneous ideas.', 'Other', 'excellent', NULL, 0.55, 45.00, 35, 1, 4, 'available', NOW(), NOW()),
('Fiction 17', 'Author 5', '9782000000017', 'New fictional adventures.', 'Fiction', 'good', NULL, 0.60, 50.00, 40, 1, 5, 'available', NOW(), NOW()),
('Non-Fiction 18', 'Author 8', '9782000000018', 'Real life stories.', 'Non-Fiction', 'very_good', NULL, 0.70, 60.00, 35, 1, 8, 'available', NOW(), NOW()),
('Mystery 19', 'Author 9', '9782000000019', 'Detective novel.', 'Mystery', 'excellent', NULL, 0.65, 55.00, 40, 1, 9, 'available', NOW(), NOW()),
('Romance 20', 'Author 10', '9782000000020', 'Love story.', 'Romance', 'good', NULL, 0.50, 35.00, 30, 1, 10, 'available', NOW(), NOW()),
('Science Fiction 21', 'Author 11', '9782000000021', 'Alien encounter.', 'Science Fiction', 'very_good', NULL, 0.75, 60.00, 45, 1, 11, 'available', NOW(), NOW()),
('Fantasy 22', 'Author 12', '9782000000022', 'Magic realm.', 'Fantasy', 'excellent', NULL, 0.80, 65.00, 50, 1, 12, 'available', NOW(), NOW()),
('Educational 23', 'Author 13', '9782000000023', 'Learn science.', 'Educational', 'good', NULL, 0.60, 50.00, 35, 1, 13, 'available', NOW(), NOW()),
('Other 24', 'Author 14', '9782000000024', 'Assorted knowledge.', 'Other', 'very_good', NULL, 0.55, 45.00, 30, 1, 14, 'available', NOW(), NOW()),
('Fiction 25', 'Author 15', '9782000000025', 'Adventure story.', 'Fiction', 'fair', NULL, 0.50, 40.00, 25, 1, 15, 'available', NOW(), NOW()),
('Non-Fiction 26', 'Author 16', '9782000000026', 'Biographical stories.', 'Non-Fiction', 'excellent', NULL, 0.70, 60.00, 40, 1, 16, 'available', NOW(), NOW()),
('Mystery 27', 'Author 17', '9782000000027', 'Crime solving story.', 'Mystery', 'good', NULL, 0.60, 50.00, 35, 1, 17, 'available', NOW(), NOW()),
('Romance 28', 'Author 18', '9782000000028', 'Romantic novel.', 'Romance', 'very_good', NULL, 0.55, 45.00, 30, 1, 18, 'available', NOW(), NOW()),
('Science Fiction 29', 'Author 1', '9782000000029', 'Space exploration.', 'Science Fiction', 'excellent', NULL, 0.80, 65.00, 50, 1, 1, 'available', NOW(), NOW()),
('Fantasy 30', 'Author 2', '9782000000030', 'Epic fantasy tale.', 'Fantasy', 'good', NULL, 0.65, 50.00, 35, 1, 2, 'available', NOW(), NOW()),
('Fiction 31', 'Author 3', '9783000000001', 'Exciting fictional story.', 'Fiction', 'very_good', NULL, 0.55, 40.00, 30, 1, 3, 'available', NOW(), NOW()),
('Non-Fiction 32', 'Author 4', '9783000000002', 'Informative non-fiction book.', 'Non-Fiction', 'excellent', NULL, 0.70, 50.00, 40, 1, 4, 'available', NOW(), NOW()),
('Mystery 33', 'Author 5', '9783000000003', 'Suspenseful mystery novel.', 'Mystery', 'good', NULL, 0.60, 45.00, 35, 1, 5, 'available', NOW(), NOW()),
('Romance 34', 'Author 8', '9783000000004', 'Romantic tale set in Italy.', 'Romance', 'fair', NULL, 0.50, 35.00, 30, 1, 8, 'available', NOW(), NOW()),
('Science Fiction 35', 'Author 9', '9783000000005', 'Sci-fi story about future.', 'Science Fiction', 'excellent', NULL, 0.80, 60.00, 50, 1, 9, 'available', NOW(), NOW()),
('Fantasy 36', 'Author 10', '9783000000006', 'Magical fantasy adventure.', 'Fantasy', 'good', NULL, 0.65, 50.00, 40, 1, 10, 'available', NOW(), NOW()),
('Educational 37', 'Author 11', '9783000000007', 'Learn programming basics.', 'Educational', 'very_good', NULL, 0.60, 45.00, 35, 1, 11, 'available', NOW(), NOW()),
('Other 38', 'Author 12', '9783000000008', 'Miscellaneous topics collection.', 'Other', 'fair', NULL, 0.55, 40.00, 30, 1, 12, 'available', NOW(), NOW()),
('Fiction 39', 'Author 13', '9783000000009', 'New fictional story.', 'Fiction', 'excellent', NULL, 0.70, 55.00, 40, 1, 13, 'available', NOW(), NOW()),
('Non-Fiction 40', 'Author 14', '9783000000010', 'Biography of famous person.', 'Non-Fiction', 'good', NULL, 0.60, 50.00, 35, 1, 14, 'available', NOW(), NOW()),
('Mystery 41', 'Author 15', '9783000000011', 'Detective story.', 'Mystery', 'very_good', NULL, 0.65, 45.00, 30, 1, 15, 'available', NOW(), NOW()),
('Romance 42', 'Author 16', '9783000000012', 'Love story with happy ending.', 'Romance', 'excellent', NULL, 0.70, 50.00, 35, 1, 16, 'available', NOW(), NOW()),
('Science Fiction 43', 'Author 17', '9783000000013', 'Interstellar adventure.', 'Science Fiction', 'good', NULL, 0.75, 55.00, 40, 1, 17, 'available', NOW(), NOW()),
('Fantasy 44', 'Author 18', '9783000000014', 'Epic fantasy saga.', 'Fantasy', 'very_good', NULL, 0.80, 60.00, 45, 1, 18, 'available', NOW(), NOW()),
('Educational 45', 'Author 1', '9783000000015', 'Learn math easily.', 'Educational', 'excellent', NULL, 0.65, 50.00, 35, 1, 1, 'available', NOW(), NOW()),
('Other 46', 'Author 2', '9783000000016', 'Miscellaneous knowledge.', 'Other', 'good', NULL, 0.55, 45.00, 30, 1, 2, 'available', NOW(), NOW()),
('Fiction 47', 'Author 3', '9783000000017', 'Adventurous fiction tale.', 'Fiction', 'fair', NULL, 0.50, 40.00, 25, 1, 3, 'available', NOW(), NOW()),
('Non-Fiction 48', 'Author 4', '9783000000018', 'Real life experiences.', 'Non-Fiction', 'very_good', NULL, 0.60, 45.00, 30, 1, 4, 'available', NOW(), NOW()),
('Mystery 49', 'Author 5', '9783000000019', 'Crime mystery novel.', 'Mystery', 'excellent', NULL, 0.70, 50.00, 35, 1, 5, 'available', NOW(), NOW()),
('Romance 50', 'Author 8', '9783000000020', 'Romantic novel story.', 'Romance', 'good', NULL, 0.55, 40.00, 30, 1, 8, 'available', NOW(), NOW()),
('Science Fiction 51', 'Author 9', '9783000000021', 'Future world exploration.', 'Science Fiction', 'very_good', NULL, 0.75, 55.00, 40, 1, 9, 'available', NOW(), NOW()),
('Fantasy 52', 'Author 10', '9783000000022', 'Magical realm adventures.', 'Fantasy', 'excellent', NULL, 0.80, 60.00, 45, 1, 10, 'available', NOW(), NOW()),
('Educational 53', 'Author 11', '9783000000023', 'Learn coding with examples.', 'Educational', 'good', NULL, 0.65, 50.00, 35, 1, 11, 'available', NOW(), NOW()),
('Other 54', 'Author 12', '9783000000024', 'Assorted knowledge collection.', 'Other', 'very_good', NULL, 0.55, 45.00, 30, 1, 12, 'available', NOW(), NOW()),
('Fiction 55', 'Author 13', '9783000000025', 'Exciting fictional adventure.', 'Fiction', 'excellent', NULL, 0.70, 55.00, 40, 1, 13, 'available', NOW(), NOW()),
('Non-Fiction 56', 'Author 14', '9783000000026', 'Educational biography.', 'Non-Fiction', 'good', NULL, 0.60, 50.00, 35, 1, 14, 'available', NOW(), NOW()),
('Mystery 57', 'Author 15', '9783000000027', 'Solve the mystery.', 'Mystery', 'very_good', NULL, 0.65, 45.00, 30, 1, 15, 'available', NOW(), NOW()),
('Romance 58', 'Author 16', '9783000000028', 'Romantic adventure story.', 'Romance', 'excellent', NULL, 0.70, 50.00, 35, 1, 16, 'available', NOW(), NOW()),
('Science Fiction 59', 'Author 17', '9783000000029', 'Sci-fi journey.', 'Science Fiction', 'good', NULL, 0.75, 55.00, 40, 1, 17, 'available', NOW(), NOW()),
('Fantasy 60', 'Author 18', '9783000000030', 'Epic magical tales.', 'Fantasy', 'very_good', NULL, 0.80, 60.00, 45, 1, 18, 'available', NOW(), NOW()),
('Fictional Journey', 'Author 14', '9784000000001', 'An exciting fiction adventure.', 'Fiction', 'good', NULL, 0.60, 45.00, 30, 1, 14, 'available', NOW(), NOW()),
('Mystery of the Night', 'Author 14', '9784000000002', 'A thrilling mystery novel.', 'Mystery', 'very_good', NULL, 0.65, 50.00, 35, 1, 14, 'available', NOW(), NOW()),
('Romantic Dreams', 'Author 14', '9784000000003', 'Heartwarming romance story.', 'Romance', 'excellent', NULL, 0.55, 40.00, 30, 1, 14, 'available', NOW(), NOW()),
('Fantasy World', 'Author 14', '9784000000004', 'Magical adventures in a fantasy world.', 'Fantasy', 'good', NULL, 0.70, 55.00, 40, 1, 14, 'available', NOW(), NOW()),
('Sci-Fi Odyssey', 'Author 14', '9784000000005', 'A journey through space.', 'Science Fiction', 'very_good', NULL, 0.75, 60.00, 45, 1, 14, 'available', NOW(), NOW()),
('Educational Insights', 'Author 14', '9784000000006', 'Learn and improve your knowledge.', 'Educational', 'excellent', NULL, 0.65, 50.00, 35, 1, 14, 'available', NOW(), NOW()),
('Other Topics', 'Author 14', '9784000000007', 'Collection of miscellaneous topics.', 'Other', 'good', NULL, 0.55, 45.00, 30, 1, 14, 'available', NOW(), NOW()),
('Fiction Tales', 'Author 14', '9784000000008', 'Fictional story for everyone.', 'Fiction', 'excellent', NULL, 0.60, 50.00, 35, 1, 14, 'available', NOW(), NOW()),
('Mystery Secrets', 'Author 14', '9784000000009', 'Uncover the secrets in this story.', 'Mystery', 'good', NULL, 0.65, 45.00, 30, 1, 14, 'available', NOW(), NOW()),
('Romantic Adventure', 'Author 14', '9784000000010', 'A romantic adventure story.', 'Romance', 'very_good', NULL, 0.55, 40.00, 30, 1, 14, 'available', NOW(), NOW());


DELETE FROM users
WHERE email = 'u4@gmail.com';


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
