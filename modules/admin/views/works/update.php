<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Works */

$this->title = 'Редактирование Работы: ' . $model->name;
?>

<div class="works-update">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
