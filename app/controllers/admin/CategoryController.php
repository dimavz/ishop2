<?php

namespace app\controllers\admin;
use app\models\AppModel;
use app\models\CategoryModel;
use ishop\App;
use RedBeanPHP\R;

class CategoryController extends AppController {

    public function indexAction(){
        $this->setMeta('Список категорий');
    }

    public function deleteAction(){
        $id = $this->getRequestID();

        $category = R::load('category', $id);
        $title = $category->title;

        $children = R::count('category', 'parent_id = ?', [$id]);
        $errors = '';
        if($children){
            $errors .= '<li>Удаление категории '.$title.' невозможно, в ней есть вложенные категории</li>';
        }
        $products = R::count('product', 'category_id = ?', [$id]);
        if($products){
            $errors .= '<li>Удаление категории '.$title.' невозможно, в ней есть товары</li>';
        }
        if($errors){
            $_SESSION['error'] = "<ul>$errors</ul>";
            redirect();
        }
        R::trash($category);
        $_SESSION['success'] = "Категория {$title} удалена";
        redirect();
    }

    public function addAction(){
        if(!empty($_POST)){
            $category = new CategoryModel();
            $data = $_POST;
            $category->loadFormData($data);
            if(!$category->validate($data)){
                $category->getErrors();
                redirect();
            }
            if($id = $category->save('category')){
                $alias = AppModel::createAlias('category', 'alias', $data['title'], $id);
                $cat = R::load('category', $id);
                $cat->alias = $alias;
                $title = $cat->title;
                R::store($cat);
                $_SESSION['success'] = "Категория {$title} добавлена";
                redirect(ADMIN.'/category');
            }
        }
        $this->setMeta('Новая категория');
    }

    public function editAction(){
        if(!empty($_POST)){
            $id = $this->getRequestID(false);
            $category = new CategoryModel();
            $data = $_POST;
            $category->loadFormData($data);
            if(!$category->validate($data)){
                $category->getErrors();
                redirect();
            }
            if($category->update('category', $id)){
                $alias = AppModel::createAlias('category', 'alias', $data['title'], $id);
                $category = R::load('category', $id);
                $category->alias = $alias;
                $title = $category->title;
                R::store($category);
                $_SESSION['success'] = "Изменения в категории {$title} сохранены";
            }
            redirect();
        }
        $id = $this->getRequestID();
        $category = R::load('category', $id);
        App::$properties->setProperty('parent_id', $category->parent_id);
        $this->setMeta("Редактирование категории {$category->title}");
        $this->setData(compact('category'));
    }

}