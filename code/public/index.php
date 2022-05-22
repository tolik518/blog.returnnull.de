<?php
namespace Returnnull;

define('DR', DIRECTORY_SEPARATOR);
define('ROOT',     dirname(__DIR__)    . DR);
define('HTML',     ROOT         . 'html'    . DR);
define('VENDOR',   ROOT         . 'vendor'  . DR);
define('PUBLIC',   ROOT         . 'public'  . DR);
define('SRC',      ROOT         . 'src'     . DR);

define('LAST_ARTICLE_ID', 999999);

require_once VENDOR.'autoload.php';

session_start();

$config = $_SERVER['HTTP_HOST'] == 'blog.returnnull.de' ?
          ROOT . "config.prd.php" :
          ROOT . "config.dev.php";

$mySQLConnector = new MySQLConnector($config);

$factory = new Factory();
$app = $factory->createApplication($mySQLConnector);
$app->run();
