<?php
namespace app\controllers;
use app\models\BreadcrumbsModel;
use app\models\CategoryModel;
use ishop\libs\Pagination;
use RedBeanPHP\R as R;
use ishop\App;

class CategoryController extends AppController {

    public function viewAction(){
        $alias = $this->route['alias'];
        $category = R::findOne('category', 'alias = ?', [$alias]);
        if(!$category){
            throw new \Exception('Страница не найдена', 404);
        }

        // хлебные крошки
        $breadcrumbs = BreadcrumbsModel::getBreadcrumbs($category->id);

        $cat_model = new CategoryModel();
        $ids = $cat_model->getIds($category->id);
        $ids = !$ids ? $category->id : $ids . $category->id;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = App::$properties->getProperty('pagination');
        $total = R::count('product', "category_id IN ($ids)");
        $pagination = new Pagination($page, $limit, $total);
        $start = $pagination->getStart();

        $products = R::find('product', "category_id IN ($ids) LIMIT $start, $limit");
        $this->setMeta($category->title, $category->description, $category->keywords);
        $this->setData(compact('products', 'breadcrumbs','pagination','total'));
    }

}