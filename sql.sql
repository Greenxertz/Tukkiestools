-- create the database
CREATE TABLE IF NOT EXISTS `products` (
    `product_id` int(11) NOT NUll AUTO_INCREMENT, 
    `product_name` varchar(100) NOT NUll,
    `product_category` varchar(100) NOT NUll,
    `product_description` VARCHAR(255) NOT Null,
    `product_image` varchar(255) NOT NUll,
    `product_image2` varchar(255) NOT NUll,
    `product_image3` varchar(255) NOT NUll,
    `product_image4` varchar(255) NOT NUll,
    `product_price` decimal(6,2) NOT NUll,
    `product_special_offer` INTEGER(2) NOT NUll,
    `product_color` varchar(100) NOT NUll,
    PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `orders` (
    `order_id` int(11) NOT NUll AUTO_INCREMENT, 
    `order_cost` DECIMAL(6,2) NOT NUll,
    `order_status` varchar(100) NOT NUll DEFAULT 'on hold',
    `user_id` INT(11) NOT NUll,
    `user_phone` int(11) NOT NUll,
    `user_city` varchar(255) NOT NUll,
    `user_address` varchar(255) NOT NUll,
    `order_date` DATETIME NOT NUll DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `order_items` (
    `item_id` int(11) NOT NUll AUTO_INCREMENT, 
    `order_id` int(11) NOT NUll,
    `product_id` varchar(255) NOT NUll,
    `product_name` varchar(255) NOT NUll,
    `product_image` varchar(255) NOT NUll,
    `user_id` INT(11) NOT NUll,
    `order_date` DATETIME NOT NUll DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int(11) NOT NUll AUTO_INCREMENT, 
    `user_name` varchar(100) NOT NUll,
    `user_email` varchar(100) NOT NUll,
    `user_password` varchar(100) NOT NUll,
    PRIMARY KEY (`user_id`),
    UNIQUE KEY `UX_CONSTRAINT` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- populates the database
-- Insert data into the 'users' table
INSERT INTO users (user_name, user_email, user_password) VALUES 
('John Doe', 'john.doe@example.com', 'password123'),
('Jane Smith', 'jane.smith@example.com', 'password456'),
('Mike Johnson', 'mike.johnson@example.com', 'password789');

-- Insert data into the 'products' table
INSERT INTO products (product_name, product_category, product_image, product_image2, product_image3, product_image4, product_price, product_special_offer, product_color) VALUES
('Hammer', 'Tools', 'hammer1.jpg', 'hammer2.jpg', 'hammer3.jpg', 'hammer4.jpg', 15.99, 10, 'Red'),
('Screwdriver', 'Tools', 'screwdriver1.jpg', 'screwdriver2.jpg', 'screwdriver3.jpg', 'screwdriver4.jpg', 7.99, 5, 'Blue'),
('Drill', 'Tools', 'drill1.jpg', 'drill2.jpg', 'drill3.jpg', 'drill4.jpg', 49.99, 15, 'Black'),
('Paint Brush Set', 'Art', 'paintbrush1.jpg', 'paintbrush2.jpg', 'paintbrush3.jpg', 'paintbrush4.jpg', 12.99, 20, 'Multicolor'),
('Acrylic Paint Set', 'Art', 'acrylicpaint1.jpg', 'acrylicpaint2.jpg', 'acrylicpaint3.jpg', 'acrylicpaint4.jpg', 25.99, 10, 'Multicolor'),
('Sketchbook', 'Art', 'sketchbook1.jpg', 'sketchbook2.jpg', 'sketchbook3.jpg', 'sketchbook4.jpg', 9.99, 15, 'White'),
('Laptop', 'Electronics', 'laptop1.jpg', 'laptop2.jpg', 'laptop3.jpg', 'laptop4.jpg', 899.99, 5, 'Silver'),
('Smartphone', 'Electronics', 'smartphone1.jpg', 'smartphone2.jpg', 'smartphone3.jpg', 'smartphone4.jpg', 699.99, 10, 'Black'),
('Headphones', 'Electronics', 'headphones1.jpg', 'headphones2.jpg', 'headphones3.jpg', 'headphones4.jpg', 199.99, 20, 'Black');

-- Insert data into the 'orders' table
INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES
(23.98, 'on hold', 1, 1234567890, 'New York', '123 Elm St', '2024-05-30 10:00:00'),
(49.99, 'shipped', 2, 9876543210, 'Los Angeles', '456 Oak St', '2024-05-30 11:00:00'),
(55.97, 'delivered', 3, 1231231234, 'Chicago', '789 Pine St', '2024-05-30 12:00:00');

-- Insert data into the 'order_items' table
INSERT INTO order_items (order_id, product_id, product_name, product_image, user_id, order_date) VALUES
(1, 1, 'Hammer', 'hammer1.jpg', 1, '2024-05-30 10:00:00'),
(1, 2, 'Screwdriver', 'screwdriver1.jpg', 1, '2024-05-30 10:00:00'),
(2, 3, 'Drill', 'drill1.jpg', 2, '2024-05-30 11:00:00'),
(3, 4, 'Paint Brush Set', 'paintbrush1.jpg', 3, '2024-05-30 12:00:00'),
(3, 5, 'Acrylic Paint Set', 'acrylicpaint1.jpg', 3, '2024-05-30 12:00:00'),
(3, 6, 'Sketchbook', 'sketchbook1.jpg', 3, '2024-05-30 12:00:00');
