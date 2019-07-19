<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php $mainImg = $model->getImage(); ?>
    <div class="form-group">
        <?= Html::img('@web/' . $mainImg->getPath('x250'), ['id' => 'preview_img', 'alt' => 'Превью']); ?>
    </div>
    <?= $form->field($model, 'image')->fileInput(['id' => 'image']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS
    function handleFileSelect(evt) {
        var file = evt.target.files;
        var f = file[0];
        if (!f.type.match('image.*')) {
            alert("Данный файл не изображение!!!");
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                var img = document.getElementById("preview_img");
                img.src = e.target.result;
            };
        })(f);
        reader.readAsDataURL(f);
    }
    document.getElementById('image').addEventListener('change', handleFileSelect, false);
JS;

$this->registerJs($script, View::POS_READY);

?>
