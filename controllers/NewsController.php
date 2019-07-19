<?php

namespace app\controllers;


use app\models\News;
use yii\data\Pagination;

class NewsController extends AllController {

    public function actionView($translit) {
        $news = News::find()->where(['translit' => $translit])->one();
        $other_news = News::find()->where(['not in', 'id', $news->id])->orderBy(['id' => SORT_DESC])->limit(5)->all();

        $this->setMeta('Новость: ' . $news['name'], $news['meta_keywords'], $news['meta_description']);

        return $this->render('view', compact('news', 'other_news'));
    }

    public function actionAllNews() {
        $news_query = News::find()->orderBy(['created_at' => SORT_DESC]);

        $pages = new Pagination(['totalCount' => $news_query->count(), 'pageSize' => 12, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $news = $news_query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('Все новости');

        return $this->render('allNews', compact('news', 'pages'));
    }

}