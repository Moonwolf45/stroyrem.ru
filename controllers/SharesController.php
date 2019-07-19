<?php

namespace app\controllers;


use app\models\Shares;
use yii\data\Pagination;

class SharesController extends AllController {

    public function actionView($translit) {
        $share = Shares::find()->where(['translit' => $translit])->one();
        $other_share = Shares::find()->where(['not in', 'id', $share->id])->orderBy(['id' => SORT_DESC])->limit(5)->all();

        $this->setMeta('Акция: ' . $share['name'], $share['meta_keywords'], $share['meta_description']);

        return $this->render('view', compact('share', 'other_share'));
    }

    public function actionAllShares() {
        $shares_query = Shares::find()->orderBy(['created_at' => SORT_DESC]);

        $pages = new Pagination(['totalCount' => $shares_query->count(), 'pageSize' => 12, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $shares = $shares_query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('Все акции');

        return $this->render('allShares', compact('shares', 'pages'));

    }
}