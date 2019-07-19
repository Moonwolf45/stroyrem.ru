<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 19.07.2018
 * Time: 20:30
 */

namespace app\components;


use app\models\Pages;
use yii\base\Widget;
use yii\caching\DbDependency;

class PagesWidget extends Widget {

    public function init() {
        parent::init();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function run() {
        $dep = new DbDependency(['sql' => 'SELECT COUNT(*) FROM {{%pages}}']);
        $pages = Pages::getDb()->cache(function ($db) {
            return Pages::find()->all();
        }, 3600, $dep);

        return $this->render('pages_widget', compact('pages'));
    }

}