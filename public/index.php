<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 29.10.2018
 * Time: 17:41
 */
require_once dirname(__DIR__).'/config/init.php';
require_once LIBS.'/functions.php';


new \ishop\App();

throw new Exception('Произошла ошибка',502);