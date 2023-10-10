CREATE TABLE `Users` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `username` varchar(45) NOT NULL,
                         `password` varchar(60) DEFAULT NULL,
                         `firstname` varchar(45) NOT NULL,
                         `lastname` varchar(45) NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `Users_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO blog.Users (id, username, password, firstname, lastname)
VALUES (1, 'tolik518', '$2a$12$xhTnIaTKwmnUBUukx2IFyuUzXGFxgTW.x2maJo1vv0MEdH2eeoa4q', 'Anatolij', 'Vasilev');
