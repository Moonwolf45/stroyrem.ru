<?php

namespace app\controllers;


use app\models\Category;
use app\models\Works;
use yii\data\Pagination;

class CategoryController extends AllController {

    public function actionView($translit) {
        $glav_category = Category::find()->where(['translit' => $translit])->one();
        $categorys = Category::find()->where(['parent_id' => $glav_category->id])->all();

        $works_category_id = self::listCategoriesAsTree($glav_category->id);
        array_push($works_category_id, $glav_category->id);

        $works_query = Works::find()->where(['category_id' => $works_category_id])->with('category');
        $pages = new Pagination(['totalCount' => $works_query->count(), 'pageSize' => 12, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $works = $works_query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('Категория: ' . $glav_category['name'], $glav_category['meta_keywords'], $glav_category['meta_description']);

        return $this->render('view', compact('glav_category', 'categorys', 'works', 'pages'));
    }

    function listCategoriesAsTree($uid = 0) {
        $items = [];

        $categories = Category::find()->where(['parent_id' => $uid])->all();

        foreach ($categories as $category) {
            $items[] = $category->id;
            self::listCategoriesAsTree($category->id);
        }

        return $items;
    }

}