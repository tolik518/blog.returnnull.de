CREATE TABLE `Articles` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `firstname` varchar(45) NOT NULL,
                            `lastname` varchar(45) NOT NULL,
                            `length` int NOT NULL,
                            `title` text NOT NULL,
                            `titleshort` text NOT NULL,
                            `slug` text NOT NULL,
                            `text` text NOT NULL,
                            `description` text,
                            `date` datetime NOT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO blog.Articles (firstname, lastname, length, title, titleshort, slug, text, description, date) VALUES ('', '', 1345, 'Hello World, Hello Github, Hello Hacktober!', 'Hello World!', 'Hello_World_Hello_Github_Hello_Hacktober', 'Hello there, tech enthusiast!</br> </br>

If you\'re reading this, it means you\'ve successfully set up this blog locally. Congratulations! </br></br>

This blog is a unique, retro-styled platform built with PHP and Docker. It\'s designed to provide a nostalgic yet efficient blogging experience. Whether you\'re a seasoned coder or a newbie, there\'s something for you to do and learn here. </br></br>

As you explore, you\'ll find various features and functionalities that make this blog special. From the admin panel where you can write and manage your blog entries, to the user-friendly interface that makes reading and navigation a breeze, every aspect of this blog has been carefully crafted.</br></br>

But the journey doesn\'t stop here. This blog is open for contributions. You can help us improve by fixing bugs, adding new features, or even suggesting improvements. Every contribution, no matter how small, is valuable and appreciated. </br></br>

So, go ahead and explore. Write a blog entry, tweak the design, or dive into the code. This is your playground.

Happy blogging and happy hacking!', 'Welcome to our locally set up, retro-styled PHP blog! Explore features, write entries, and contribute to improvements. Dive into the code, enhance your skills, and join our collaborative community. Happy blogging and hacking!', '2023-10-10 09:20:01');
