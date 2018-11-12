<?php
/**
 Определение констант
 */
define("DEBUG",1); //Констатна для режима разработки или продакшена, 1 - режим разработки, 0 - режим продакшена
define("ROOT",dirname(__DIR__)); //Констатна для указания на корень сайта
define("WWW",ROOT.'/public'); //Констатна для указания на папку сайта, в которой храняться публичные файлы сайта
define("APP",ROOT.'/app'); //Констатна для указания на папку сайта, в которой храняться файлы приложения сайта
define("CORE",ROOT.'/vendor/ishop/core'); //Констатна для указания на папку сайта, в которой храняться файлы ядра сайта
define("LIBS",ROOT.'/vendor/ishop/core/libs'); //Констатна для указания на папку сайта, в которой храняться файлы библиотек сайта
define("CACHE",ROOT.'/tmp/cache'); //Констатна для указания на папку сайта, в которой храняться файлы кэша сайта
define("CONFIG",ROOT.'/config'); //Констатна для указания на папку сайта, в которой храняться файлы конфигурации сайта
define("LAYOUT",'watches'); //Констатна для указания шаблона сайта по умолчанию

$app_path = "http://{$_SERVER['HTTP_HOST']}";
define("PATH",$app_path); //Констатна для домена сайта
define("ADMIN",PATH.'/administrator'); //Констатна для директории админки сайта
require_once ROOT.'/vendor/autoload.php'; //Подключаем автозагрузчик классов

//http://ishop2.loc/public/index.php
//$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
//http://ishop2.loc/public/
//$app_path = preg_replace("#[^/]+$#",'',$app_path);
//$app_path = str_replace('/public/','',$app_path);




