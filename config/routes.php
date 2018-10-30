<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 30.10.2018
 * Time: 15:32
 */
use ishop\Router;

//Router::add('^articles/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$\'',['controller'=>'articles','action'=>'view']);

// default routes administrator
Router::add('^admin$',['controller'=>'Main','action'=>'index', 'prefix'=>'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix'=>'admin']);

// default routes
Router::add('^$',['controller'=>'Main','action'=>'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');