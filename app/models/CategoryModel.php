<?php

namespace app\models;
use ishop\App;

class CategoryModel extends AppModel {

    public function getIds($id){
        $cats = App::$properties->getProperty('categories');
        $ids = null;
        foreach($cats as $k => $v){
            if($v['parent_id'] == $id){
                $ids .= $k . ',';
                $ids .= $this->getIds($k);
            }
        }
        return $ids;
    }

}