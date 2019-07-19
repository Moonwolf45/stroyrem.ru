<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Shares */

$this->title = $model->name;
?>

<div class="shares-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-lg btn-primary']); ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-lg btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данную акцию?',
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'text:html',
        ],
    ]); ?>

</div>
