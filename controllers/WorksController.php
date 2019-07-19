<?php

namespace app\controllers;


use app\models\Works;

class WorksController extends AllController {

    public function actionView($category_translit, $works_translit) {
        $works = Works::find()->where(['translit' => $works_translit])->one();

        $this->setMeta('Наши работы: ' . $works['name'], $works['meta_keywords'], $works['meta_description']);

        return $this->render('view', compact('works'));
    }

}