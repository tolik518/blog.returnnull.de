<?php

define("DB_HOST", 'database');
define("DB_NAME", 'blog');
define("DB_PORT", '3306');
define("DB_USER", 'root');
define("DB_PASS", 'admin');

const DB_DSN = 'mysql:host='   . DB_HOST . ';' .
                     'port='   . DB_PORT . ';' .
                     'dbname=' . DB_NAME;