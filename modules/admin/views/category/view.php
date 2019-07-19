<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
?>

<div class="category-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-lg btn-primary']); ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-lg btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данную категорию?',
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                    return '<img class="img-rounded" src="/' . str_replace("\\", "/", $image->getPath("x100")) . '" alt="' . $image["urlAlias"] . '">';
                },
            ],
            [
                'attribute' => 'background',
                'format' => 'html',
                'value' => function($data) {
                    $images = $data->getImages();
                    if (count($images) > 1) {
                        return '<img class="img-rounded" src="/' . str_replace("\\", "/", $images[1]->getPath("x100")) . '" alt="' . $images[1]["urlAlias"] . '">';
                    } else {
                        return '<img class="img-rounded" src="/images/placeHolder.png" alt="Превью" style="height:100px;">';
                    }
                },
            ],
            'meta_keywords',
            'meta_description',
            'text:html',
        ],
    ]); ?>

</div>
