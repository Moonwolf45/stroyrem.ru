<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Слайдер';
?>
<div class="slider-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать слайд', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    $image = $data->getImage();
                    return Html::img('@web/' . $image->getPath("x100"), ['alt' => $image["urlAlias"], 'class' => 'img-rounded']);
                },
            ],
            'title:html',
            'content:html',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
