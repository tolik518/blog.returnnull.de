CREATE TABLE `ArticleTags` (
                               `uID` int NOT NULL AUTO_INCREMENT,
                               `tagsID` int NOT NULL,
                               `articleID` int DEFAULT NULL,
                               PRIMARY KEY (`uID`),
                               UNIQUE KEY `ArticleTags_uID_uindex` (`uID`),
                               KEY `ArticleTags_Articles_id_fk` (`articleID`),
                               KEY `ArticleTags_Tags_id_fk` (`tagsID`),
                               CONSTRAINT `ArticleTags_Articles_id_fk` FOREIGN KEY (`articleID`) REFERENCES `Articles` (`id`),
                               CONSTRAINT `ArticleTags_Tags_id_fk` FOREIGN KEY (`tagsID`) REFERENCES `Tags` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

