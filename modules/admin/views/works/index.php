<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Наши работы';
?>

<div class="works-index">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Создать работу', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'category_id',
                'format' => 'html',
                'value' => function($data) {
                    return $data->category->name;
                },
            ],
            'name',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    $image_work = $data->getImage();
                    return Html::img('@web/' . $image_work->getPath('x100'), ['alt' => $image_work['urlAlias'], 'class' => 'img-rounded']);
                },
            ],
            'meta_keywords',
            'meta_description',
            [
                'attribute' => 'price',
                'format' => ['decimal', 2],
                'headerOptions' => ['width' => '120'],
            ],
            [
                'attribute' => 'best_work',
                'format' => 'html',
                'value' => function($data) {
                    if ($data->best_work) {
                        return '<p class="text-success">Да</p>';
                    } else {
                        return '<p class="text-danger">Нет</p>';
                    }
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '100'],
            ],
        ],
    ]); ?>
</div>
