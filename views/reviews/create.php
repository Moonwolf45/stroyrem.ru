<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>


<div class="container bg_white">
    <h1 style="font-size:36px;">Создание отзыва</h1>

    <?php Pjax::begin(); ?>
        <?php if (Yii::$app->session->hasFlash('review_add')): ?>
            <div class="alert alert-success">
                Спасибо за ваш отзыв, он будет опубликован после проверки.
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-12">
                    <?php $form = ActiveForm::begin([
                        'options' => ['data' => ['pjax' => true]],
                    ]); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]); ?>

                        <?= $form->field($model, 'rating')->radioList(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'], ['separator' => ' ']); ?>

                        <?= $form->field($model, 'text')->textarea(['rows' => 6]); ?>

                        <div class="form-group">
                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-lg btn-success']); ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        <?php endif; ?>
    <?php Pjax::end(); ?>
</div>