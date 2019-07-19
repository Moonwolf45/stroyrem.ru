<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 19.07.2018
 * Time: 19:58
 */

namespace app\components;


use app\models\Shares;
use yii\base\Widget;
use yii\caching\DbDependency;

class SharesWidget extends Widget {

    public function init() {
        parent::init();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function run() {
        $dep = new DbDependency(['sql' => 'SELECT COUNT(*) FROM {{%shares}}']);
        $shares_two_end = Shares::getDb()->cache(function ($db) {
            return Shares::find()->orderBy(['created_at' => SORT_DESC])->limit(2)->all();
        }, 3600, $dep);

        return $this->render('shares_widget', compact('shares_two_end'));
    }
}