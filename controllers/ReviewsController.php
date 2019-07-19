<?php

namespace app\controllers;


use app\models\Reviews;
use Yii;
use yii\data\Pagination;

class ReviewsController extends AllController {

    public function actionAllReviews() {
        $reviews_query = Reviews::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC]);

        $pages = new Pagination(['totalCount' => $reviews_query->count()]);
        $reviews = $reviews_query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('Все отзывы');

        return $this->render('all-reviews', compact('reviews', 'pages'));
    }

    public function actionCreateReview() {
        $model = new Reviews();
        $model->status = false;

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('review_add');
            }

            return $this->refresh();
        }

        $this->setMeta('Написать отзыв');

        return $this->render('create', compact('model'));
    }

}