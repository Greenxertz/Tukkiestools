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