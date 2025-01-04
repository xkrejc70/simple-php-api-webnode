CREATE DATABASE IF NOT EXISTS app_db;

USE app_db;

CREATE TABLE IF NOT EXISTS `order` (
    id VARCHAR(36) PRIMARY KEY,
    creation_date DATETIME NOT NULL,
    name VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    currency VARCHAR(10) NOT NULL,
    status VARCHAR(50) NOT NULL
);

CREATE TABLE `order_items` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(36) NOT NULL,
    name VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES `order`(id) ON DELETE CASCADE
);

INSERT INTO `order` (id, creation_date, name, amount, currency, status) VALUES
('1', '2025-01-01 10:00:00', 'Order 1', 1000.00, 'CZK', 'pending'),
('2', '2025-01-02 12:00:00', 'Order 2', 200.00, 'CZK', 'new'),
('3', '2025-01-03 14:00:00', 'Order 3', 50.00, 'USD', 'finished');

INSERT INTO `order_items` (order_id, name, amount) VALUES
('1', 'Item 1 for Order 1', 500.00),
('1', 'Item 2 for Order 1', 500.00),
('2', 'Item 1 for Order 2', 100.00),
('2', 'Item 2 for Order 2', 100.00),
('3', 'Item 1 for Order 3', 50.00);