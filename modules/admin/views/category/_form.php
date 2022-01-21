<?php

use app\components\MenuWidget;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-group field-category-parent_id">
        <label class="control-label" for="category-parent_id">Родительсккая категория</label>
        <select id="category-parent_id" class="form-control" name="Category[parent_id]" aria-invalid="false">
            <option value="0">Самостоятельная категория</option>
            <?php echo MenuWidget::widget(['tpl' => 'select', 'model' => $model]); ?>
        </select>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <div class="row">
        <div class="form-group preview_image">
            <?php $mainImg = $model->getImages(); ?>
            <?= Html::img('@web/' . $mainImg[0]->getPath('x250'), ['id' => 'preview_img', 'alt' => 'Превью']); ?>
            <?= $form->field($model, 'image')->fileInput(['id' => 'image']); ?>
        </div>

        <div class="form-group preview_bg">
            <?php if(count($mainImg) > 1): ?>
                <?= Html::img('@web/' . $mainImg[1]->getPath('x250'), ['id' => 'preview_bg', 'alt' => 'Превью']); ?>
            <?php else: ?>
                <?= Html::img('@web/images/placeHolder.png', ['id' => 'preview_bg', 'alt' => 'Превью']); ?>
            <?php endif; ?>
            <?= $form->field($model, 'background')->fileInput(['id' => 'background']); ?>
        </div>
    </div>

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

    function handleFileSelect_bg(evt) {
        var file = evt.target.files;
        var f = file[0];
        if (!f.type.match('image.*')) {
            alert("Данный файл не изображение!!!");
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                var img = document.getElementById("preview_bg");
                img.src = e.target.result;
            };
        })(f);
        reader.readAsDataURL(f);
    }
    document.getElementById('background').addEventListener('change', handleFileSelect_bg, false);
JS;

$this->registerJs($script, View::POS_READY);
?>