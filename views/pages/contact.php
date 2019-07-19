<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;
use yii\widgets\MaskedInput;
use yii\widgets\Pjax;

?>

<div class="container bg_white">
    <h1>Обратная связь</h1>

    <?php Pjax::begin(); ?>
        <?php if (Yii::$app->session->hasFlash('form_to_send')): ?>
            <div class="alert alert-success">
                Спасибо за ваше обращение, мы свяжемся в ближайшее время.
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin([
                        'options' => ['data' => ['pjax' => true], 'enctype' => 'multipart/form-data'],
                        'id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]); ?>

                        <?= $form->field($model, 'tel')->widget(MaskedInput::class, [
                            'mask' => '+7 (999) 999-99-99']); ?>

                        <?= $form->field($model, 'email'); ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6]); ?>

                        <?= $form->field($model, 'at_file[]')->fileInput(['multiple' => true]); ?>

                        <?= $form->field($model, 'reCaptcha')->widget(ReCaptcha::class,
                            ['siteKey' => '6LfRS28UAAAAAKt26QdCSBpcVwPwEh3cwjxAZYBv'])->label(false); ?>

                        <div class="form-group">
                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']); ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        <?php endif; ?>
    <?php Pjax::end(); ?>
</div>
