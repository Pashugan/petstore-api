CREATE TABLE `order` (
    id BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pet_id BIGINT NOT NULL,
    quantity INT NOT NULL,
    ship_date DATETIME NOT NULL,
    status ENUM('placed', 'approved', 'delivered'),
    complete BOOL DEFAULT 0
);

INSERT INTO `order` VALUES (null, 1, 1, NOW(), 'placed', 0);
