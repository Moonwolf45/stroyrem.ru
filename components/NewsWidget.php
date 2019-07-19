<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 19.07.2018
 * Time: 19:36
 */

namespace app\components;


use app\models\News;
use yii\base\Widget;
use yii\caching\DbDependency;

class NewsWidget extends Widget {

    public function init() {
        parent::init();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function run() {
        $dep = new DbDependency(['sql' => 'SELECT COUNT(*) FROM {{%news}}']);
        $news_tree_end = News::getDb()->cache(function ($db) {
            return News::find()->orderBy(['created_at' => SORT_DESC])->limit(3)->all();
        }, 3600, $dep);

        return $this->render('news_widget', compact('news_tree_end'));
    }
}