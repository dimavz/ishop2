<?php

namespace app\controllers\admin;
use app\models\CategoryModel;
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
                $_SESSION['success'] = "Категория добавлена";
                redirect(ADMIN.'/category');
            }
        }
        $this->setMeta('Новая категория');
    }

}