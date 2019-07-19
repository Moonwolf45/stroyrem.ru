<?php

namespace app\components;


use app\models\Slider;
use yii\base\Widget;
use yii\caching\DbDependency;

class SliderWidget extends Widget {

    public function init() {
        parent::init();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function run() {
        $dep = new DbDependency(['sql' => 'SELECT COUNT(*) FROM {{%slider}}']);
        $slider = Slider::getDb()->cache(function ($db) {
            return Slider::find()->all();
        }, 3600, $dep);

        return $this->render('slider_widget', compact('slider'));
    }

}