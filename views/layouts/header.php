<?php

use app\components\PagesWidget;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php echo PagesWidget::widget(); ?>

<div class="inner">
    <header>
        <h1>
            <a href="<?= Url::home(); ?>" id="logo">
                <?php echo Html::img('@web/images/PRT.png', ['class' => 'logo_image', 'alt' => 'Logo PRT']); ?>
            </a>
            <p>P = Project - Стройка, строительный объект, осуществляемое строительство.<br>
                R = Repair - Ремонт, восстановление, исправление, починка, исправность.<br>
                T = Trim - Отделка, порядок, готовность, подравнивание, внутренняя отделка.<br></p>
        </h1>
        <hr>
    </header>
</div>