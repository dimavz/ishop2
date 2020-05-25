<?php

namespace app\widgets\filter;

use ishop\Cache;
use RedBeanPHP\R;

class Filter{

    protected $groups;
    protected $attrs;
    protected $tpl;

    public function __construct(){
        $this->tpl = __DIR__ . '/tmpl/default.php';
        $this->run();
    }

    protected function run(){
        $cache = Cache::getInstance();
        $this->groups = $cache->get('filter_group');
        if(!$this->groups){
            $this->groups = $this->getGroups();
            $cache->set('filter_group', $this->groups, 30);
        }
        $this->attrs = $cache->get('filter_attrs');
        if(!$this->attrs){
            $this->attrs = self::getAttrs();
            $cache->set('filter_attrs', $this->attrs, 30);
        }
        $filters = $this->getHtml();
        echo $filters;
    }

    protected function getHtml(){
        ob_start();
        $filter = self::getFilter();
        if(!empty($filter)){
            $filter = explode(',', $filter);
        }
        require $this->tpl;
        return ob_get_clean();
    }

    protected function getGroups(){
        return R::getAssoc('SELECT id, title FROM attribute_group');
    }

    protected static function getAttrs(){
        $data = R::getAssoc('SELECT * FROM attribute_value');
        $attrs = [];
        foreach($data as $k => $v){
            $attrs[$v['attr_group_id']][$k] = $v['value'];
        }
        return $attrs;
    }

    public static function getFilter(){
        $filter = null;
        if(!empty($_GET['filter'])){
            $filter = preg_replace("#[^\d,]+#", '', $_GET['filter']); // Отбираем из данных фильтра только цифры и запятые, к примеру 1,4,5,
            $filter = trim($filter, ','); // Обрезаем конечную запятую из данных фильтра
        }
        return $filter;
    }

    public static function getCountGroups($filter){
        $filters = explode(',', $filter);
        $cache = Cache::getInstance();
        $attrs = $cache->get('filter_attrs');
        if(empty($attrs)){
            $attrs = self::getAttrs();
        }
        $data = [];
        foreach($attrs as $key => $item){
            foreach($item as $k => $v){
                if(in_array($k, $filters)){
                    $data[] = $key;
                    break;
                }
            }
        }
        return count($data);
    }

}