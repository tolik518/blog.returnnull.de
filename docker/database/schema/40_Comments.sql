CREATE TABLE `Comments` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `articleID` int NOT NULL,
                            `replytoID` int DEFAULT NULL,
                            `username` varchar(45) NOT NULL,
                            `text` text NOT NULL,
                            `date` datetime NOT NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `Comments_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

