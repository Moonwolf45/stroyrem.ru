<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\FontsAsset;
use app\assets\AppAsset;
use app\assets\ltAppAsset;
use app\assets\nsAppAsset;

FontsAsset::register($this);
AppAsset::register($this);
ltAppAsset::register($this);
nsAppAsset::register($this); ?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language; ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; <?=Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?=Html::csrfMetaTags(); ?>
    <title>Админка PRT</title>
    <?php $this->head(); ?>

    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
<?php $this->beginBody(); ?>
<header>
    <div class="container">
        <a href="<?= Url::to(['/admin/category']); ?>" class="btn menu-btn">Категории</a>
        <a href="<?= Url::to(['/admin/slider']); ?>" class="btn menu-btn">Слайдер</a>
        <a href="<?= Url::to(['/admin/works']); ?>" class="btn menu-btn">Портфолио</a>
        <a href="<?= Url::to(['/admin/news']); ?>" class="btn menu-btn">Новости</a>
        <a href="<?= Url::to(['/admin/shares']); ?>" class="btn menu-btn">Акции</a>
        <a href="<?= Url::to(['/admin/pages']); ?>" class="btn menu-btn">Страницы</a>
        <a href="<?= Url::to(['/admin/reviews']); ?>" class="btn menu-btn">Отзывы</a>
        <a href="<?= Url::to(['/site/logout']); ?>" class="btn menu-btn exit">Выход</a>
    </div>
</header>
<main>
    <div class="container bg_white">
        <?php echo $content;?>
    </div>
</main>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>