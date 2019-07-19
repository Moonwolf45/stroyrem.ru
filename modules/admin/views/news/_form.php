<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?php $mainImg = $model->getImage(); ?>
    <div class="form-group">
        <?= Html::img('/' . $mainImg->getPath('x250'), ['id' => 'preview_img', 'alt' => 'Превью']); ?>
    </div>
    <?= $form->field($model, 'image')->fileInput(['id' => 'image']); ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]); ?>

    <?php echo $form->field($model, 'text')->widget(CKEditor::class, [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [])
    ]); ?>

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
