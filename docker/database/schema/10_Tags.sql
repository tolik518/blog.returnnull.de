CREATE TABLE `Tags` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `tag` varchar(45) NOT NULL,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `tags_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO blog.Tags (tag) VALUES ('hello_world');
INSERT INTO blog.Tags (tag) VALUES ('gameboy');
INSERT INTO blog.Tags (tag) VALUES ('statistics');
INSERT INTO blog.Tags (tag) VALUES ('C');
INSERT INTO blog.Tags (tag) VALUES ('R');
INSERT INTO blog.Tags (tag) VALUES ('ASM');
