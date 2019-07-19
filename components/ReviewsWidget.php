<?php

namespace app\components;


use app\models\Reviews;
use yii\base\Widget;
use yii\caching\DbDependency;

class ReviewsWidget extends Widget {

    public function init() {
        parent::init();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function run() {
        $dep = new DbDependency(['sql' => 'SELECT COUNT(*) FROM {{%reviews}}']);
        $reviews = Reviews::getDb()->cache(function ($db) {
            return Reviews::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->limit(12)->all();
        }, 3600, $dep);

        return $this->render('reviews_widget', compact('reviews'));
    }
}