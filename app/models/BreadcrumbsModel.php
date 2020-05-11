<?php


namespace app\models;

use ishop\App;

abstract class BreadcrumbsModel
{
    public static function getBreadcrumbs($category_id, $name = '')
    {
        $categories = App::$properties->getProperty('categories');
        $breadcrumbs_array = static::getParts($categories,$category_id);
        $breadcrumbs = '<li><a href="'.PATH.'">Главная</a></li>';
        foreach ($breadcrumbs_array as $alias=>$title)
        {
            $breadcrumbs .= '<li><a href="'.PATH.'/category/'.$alias.'">'.$title.'</a></li>';
        }
        if(!empty($name))
        {
            $breadcrumbs .= '<li>'.$name.'</li>';
        }
//        debug($breadcrumbs);
        return $breadcrumbs;
    }

    public static function getParts($categories,$category_id)
    {
//        debug($categories);
        if(empty($category_id)){
            return false;
        }
        $breadcrumbs = array();
        for ($i=0;$i<=count($categories);$i++)
        {
            if(isset($categories[$category_id]))
            {
                $breadcrumbs[$categories[$category_id]['alias']] = $categories[$category_id]['title'];
                $category_id = $categories[$category_id]['parent_id'];
            } else{
                break;
            }
        }
        return array_reverse($breadcrumbs);
    }
}