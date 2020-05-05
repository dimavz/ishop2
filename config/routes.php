<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 30.10.2018
 * Time: 15:32
 * В данном файле находятся правила маршрутизации
 * Можно добавлять свои кастомные правила
 * Более конкретные правила должны находиться выше чем более общие правила
 */
use ishop\Router;

//Router::add('^articles/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$\'',['controller'=>'articles','action'=>'view']);

Router::add('^product/(?P<alias>[a-z0-9-]+)/?$',['controller'=>'Product','action'=>'view']);

// default routes administrator для админской части приложения
Router::add('^admin$',['controller'=>'Main','action'=>'index', 'prefix'=>'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix'=>'admin']);

// default routes для пользовательской части приложения
Router::add('^$',['controller'=>'Main','action'=>'index']); //Маршрут для главной страницы
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');