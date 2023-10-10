CREATE TABLE `Tracker` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `ip` varchar(48) DEFAULT NULL,
                           `visitedtime` varchar(20) DEFAULT NULL,
                           `url` varchar(120) DEFAULT NULL,
                           `requestprotocol` varchar(20) DEFAULT NULL,
                           `redirectstatus` varchar(10) DEFAULT NULL,
                           `useragent` varchar(255) DEFAULT NULL,
                           `refferer` varchar(500) DEFAULT NULL,
                           PRIMARY KEY (`id`),
                           UNIQUE KEY `Tracker_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

