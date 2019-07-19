<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
?>

<div class="category-index">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'parent_id',
                'value' => function($data) {
                    return $data->category->name ? $data->category->name : 'Самостоятельная категория';
                }
            ],
            'name',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    $image = $data->getImage();
                    return Html::img('@web/' . $image->getPath("x100"), ['alt' => $image["urlAlias"], 'class' => 'img-rounded']);
                },
            ],
            [
                'attribute' => 'background',
                'format' => 'html',
                'value' => function($data) {
                    $images = $data->getImages();
                    if (count($images) > 1) {
                        return Html::img('@web/' . $images[1]->getPath("x100"), ['alt' => $images[1]["urlAlias"], 'class' => 'img-rounded']);
                    } else {
                        return Html::img('@web/images/placeHolder.png', ['alt' => 'Превью', 'style' => 'height:100px;', 'class' => 'img-rounded']);
                    }
                },
            ],
            'meta_keywords',
            'meta_description',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
