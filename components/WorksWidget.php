<?php

namespace app\components;


use app\models\Works;
use yii\base\Widget;

class WorksWidget extends Widget {

    public function init() {
        parent::init();
    }

    public function run() {
        $works_end_to_ten = Works::find()->where(['best_work' => 1])->orderBy(['id' => SORT_DESC])->with('category')->limit(10)->all();

        return $this->render('works_widget', compact('works_end_to_ten'));
    }
}