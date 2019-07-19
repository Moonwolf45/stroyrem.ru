<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Works */

$this->title = $model->name;
?>

<div class="works-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-lg btn-primary']); ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-lg btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данный товар?',
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category->name;
                }
            ],
            'name',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    $image_work = $data->getImage();
                    return Html::img('@web/' . $image_work->getPath("x100"), ['alt' => $image_work['urlAlias']]);
                },
            ],
            [
                'attribute' => 'gallery',
                'format' => 'html',
                'value' => function($data) {
                    $images = $data->getImages();
                    $image_gallery = '';
                    foreach($images as $gallary) {
                        if ($gallary['isMain'] != 1){
                            $image_gallery .=  Html::img('@web/' . $gallary->getPath("x100"), ['alt' => $gallary['urlAlias'], 'slider' => 'margin-right:10px;']);
                        }
                    }
                    return $image_gallery;
                },
            ],
            'meta_keywords',
            'meta_description',
            'text:html',
            [
                'attribute' => 'price',
                'format' => ['decimal', 2],
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
        ],
    ]); ?>

</div>
