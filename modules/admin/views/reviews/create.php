<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

$this->title = 'Создать отзыв';
?>

<div class="reviews-create">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
