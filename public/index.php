<?php

use Core\Database\PDOSingleton;
use Core\Tools\Debug;

/**
 * Entree de notre application 
 */

 require_once dirname(__DIR__) . '/config/env.php';
require_once ROOT . '/vendor/autoload.php';


$pdo = PDOSingleton::getInstance();

Debug::var_dump($pdo);