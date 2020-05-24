<?php
namespace app\controllers;
use app\models\BreadcrumbsModel;
use app\models\CategoryModel;
use app\widgets\filter\Filter;
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

        $sql_part = '';
        if(!empty($_GET['filter'])){
            /*
            SELECT `product`.*  FROM `product`  WHERE category_id IN (6) AND id IN
            (
            SELECT product_id FROM attribute_product WHERE attr_id IN (1,5)
            )
            */
            $filter = Filter::getFilter();
            if (!empty($filter))
            {
                $sql_part = "AND id IN (SELECT product_id FROM attribute_product WHERE attr_id IN ($filter))";
            }
        }

        $total = R::count('product', "category_id IN ($ids) $sql_part");
        $pagination = new Pagination($page, $limit, $total);
        $start = $pagination->getStart();

        $products = R::find('product', "category_id IN ($ids) $sql_part LIMIT $start, $limit");

        if($this->isAjax()){
            $this->loadView('filter', compact('products', 'total', 'pagination'));
        }

        $this->setMeta($category->title, $category->description, $category->keywords);
        $this->setData(compact('products', 'breadcrumbs','pagination','total'));
    }

}