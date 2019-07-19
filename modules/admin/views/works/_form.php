<?php

use app\components\MenuWidget;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\number\NumberControl;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\models\Works */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="works-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-group field-works-category_id has-success">
        <label class="control-label" for="works-category_id">Родительская категория</label>
        <select id="works-category_id" class="form-control" name="Works[category_id]">
            <?= MenuWidget::widget(['tpl' => 'select_product', 'model' => $model]); ?>
        </select>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?php $mainImg = $model->getImages(); ?>
    <div class="form-group">
        <?= Html::img('@web/' . $mainImg[0]->getPath('x250'), ['id' => 'preview_img', 'alt' => 'Превью']); ?>
    </div>
    <?= $form->field($model, 'image')->fileInput(['id' => 'image']); ?>

    <?php if(count($mainImg) > 1): ?>
    <div class="form-group">
        <div class="row">
            <?php foreach($mainImg as $gallary): ?>
                <?php if($gallary['isMain'] != 1): ?>
                    <div class="gallery" id="<?= $gallary['id']; ?>_<?= $model->id; ?>">
                        <button type="button" class="close del_gallery" data-href="/admin/works/delete-images"
                                data-model="<?= $model->id; ?>" data-image="<?= $gallary['id']; ?>">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?= Html::img('@web/' . $gallary->getPath('x250'), ['id' => 'preview_bg', 'alt' => $gallary['urlAlias'], 'class' => 'img-thumbnail']); ?>
                    </div>
                <?php endif;?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => 'true', 'accept' => 'image/*']) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]); ?>

    <?php echo $form->field($model, 'text')->widget(CKEditor::class, [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [])
    ]); ?>

    <?= $form->field($model, 'price')->widget(NumberControl::class, [
        'maskedInputOptions' => [
            'allowMinus' => false,
            'groupSeparator' => ' ',
            'radixPoint' => ',',
            'digits' => 2,
        ],
        'displayOptions' => ['class' => 'form-control kv-monospace'],
    ]); ?>

    <?= $form->field($model, 'best_work')->checkbox(); ?>

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
 
    $(".del_gallery").on("click", function (e) {
        e.preventDefault();
        var isTrue = confirm("Удалить изображение?");
        if (isTrue == true) {
            var href = $(this).data('href');
            var id_model = $(this).data('model');
            var image = $(this).data('image');
            $.ajax({
                type: 'POST',
                cache: false,
                url: href + "?id_model=" + id_model + "&image=" + image,
                success: function(data){
                    console.log(data); // выводим ответ сервера
                    $('#'+image+'_'+id_model).remove();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText + ' | ' + status + ' | ' +error);
                }
            });
        }
    });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, View::POS_READY);

?>