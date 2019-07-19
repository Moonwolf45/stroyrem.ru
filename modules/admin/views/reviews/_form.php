<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviews-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'rating')->radioList(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'], ['separator' => ' ']); ?>

    <?php $items = [0 => 'Не одобрен', 1 => 'Одобрен']; ?>
    <?= $form->field($model, 'status')->dropDownList($items, ['prompt' => 'Выберите статус отзыва']); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
