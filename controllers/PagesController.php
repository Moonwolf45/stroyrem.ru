<?php

namespace app\controllers;


use app\models\Category;
use app\models\ContactForm;
use app\models\Pages;
use app\models\Works;
use Yii;
use yii\data\Pagination;
use yii\web\UploadedFile;

class PagesController extends AllController {

    public function actionView($translit) {
        $page = Pages::find()->where(['translit' => $translit])->one();

        $this->setMeta('Страница: ' . $page['name'], $page['meta_keywords'], $page['meta_description']);

        return $this->render('view', compact('page'));
    }

    public function actionOurWorks() {
        $categorys = Category::find()->where(['parent_id' => 0])->all();

        $works_query = Works::find()->with('category');
        $pages = new Pagination(['totalCount' => $works_query->count(), 'pageSize' => 12, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $works = $works_query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('Наши работы',
            'Проекты домов, каркасные дома',
            'PRT предлагает услуги по разработке проектов домов, строительству и проведению ремонтных работ');



        return $this->render('ourWorks', compact('categorys', 'works', 'pages'));
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $model = new ContactForm();

        $this->setMeta('Обратная связь');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $name = $model->name;
            $tel = $model->tel;
            $email = $model->email;
            $question = $model->body;
            $model->at_file = UploadedFile::getInstances($model, 'at_file');
            $at_file = $model->at_file;

            $model->sendMail(Yii::$app->params['adminEmail'], 'contact', 'Обратная связь', ['name' => $name,
                'tel' => $tel, 'email' => $email, 'question' => $question, 'at_file' => $at_file]);

            Yii::$app->session->setFlash('form_to_send');
            return $this->refresh();
        }

        return $this->render('contact', compact('model'));
    }

}
