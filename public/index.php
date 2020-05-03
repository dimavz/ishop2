<?php
use ishop\App;
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 29.10.2018
 * Time: 17:41
 */
require_once dirname(__DIR__).'/config/init.php';
require_once LIBS.'/functions.php';
require_once CONFIG.'/routes.php';


new App();

//debug(App::$properties->getProperties());

//throw new Exception('Произошла ошибка',502);
//debug(\ishop\Router::getRoutes());