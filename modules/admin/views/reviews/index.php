<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отзывы';
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Написать отзыв', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'rating',
                'format' => 'html',
                'value' => function($data) {
                    $review = '';
                    $end_rest = 5 - $data->rating;
                    for ($a = 0; $a < $data->rating; $a++) {
                        $review .= '<i class="fa fa-home fa-active"></i>';
                    }

                    if($end_rest != 0) {
                        for ($b = 0; $b < $end_rest; $b++){
                            $review .= '<i class="fa fa-home"></i>';
                        }
                    }

                    return $review;
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data) {
                    if ($data->status) {
                        return '<p class="text-success">Одобрен</p>';
                    } else {
                        return '<p class="text-danger">Не одобрен</p>';
                    }
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
