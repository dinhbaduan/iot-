CREATE DATABASE smart_door;

USE smart_door;

-- Tài khoản quản trị
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255) -- mã hóa bằng bcrypt
);

-- Danh sách thẻ RFID
CREATE TABLE rfid_cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    card_uid VARCHAR(100) UNIQUE,
    owner_name VARCHAR(100),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Log lịch sử quét thẻ
CREATE TABLE access_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    card_uid VARCHAR(100),
    access_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    access_result ENUM('granted', 'denied'),
    device_name VARCHAR(100)
);

-- Trạng thái thiết bị
CREATE TABLE devices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    device_name VARCHAR(100),
    last_online TIMESTAMP,
    status ENUM('online', 'offline') DEFAULT 'offline'
);
