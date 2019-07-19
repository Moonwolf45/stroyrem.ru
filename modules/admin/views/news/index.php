<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
?>

<div class="news-index">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Создать новость', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    $image = $data->getImage();
                    return Html::img('@web/' . $image->getPath("x100"), ['alt' => $image["urlAlias"], 'class' => 'img-rounded']);
                },
            ],
            'meta_keywords',
            'meta_description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
