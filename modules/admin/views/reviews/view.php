<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

$this->title = $model->name;
?>

<div class="reviews-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данный отзыв?',
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'text:html',
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
        ],
    ]) ?>

</div>
