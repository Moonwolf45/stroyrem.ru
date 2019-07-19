<?php

namespace app\modules\admin\controllers;


use yii\web\Controller;

class AllAdminController extends Controller {

    protected function setMeta($title = 'Админка PRT') {
        $this->view->title = $title;
    }

}