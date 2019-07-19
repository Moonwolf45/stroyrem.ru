<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<div class="container bg_white">
    <?php if(!empty($works)): ?>
        <div class="row">
            <h3 style="width:100%;">Категории: </h3>
            <?php foreach ($categorys as $category): ?>
                <article class="col-3 col-12-mobile special">
                    <a href="<?php echo Url::to(['/category/view', 'translit' => $category['translit']]); ?>" class="image featured">
                        <?php $image_category_widget = $category->getImage(); ?>
                        <img class="img-rounded" src="/<?php echo $image_category_widget->getPath('x305'); ?>" alt="<?php echo $image_category_widget['urlAlias']; ?>">
                    </a>
                    <header>
                        <h3>
                            <a href="<?php echo Url::to(['/category/view', 'translit' => $category['translit']]); ?>">
                                <?php echo $category['name']; ?>
                            </a>
                        </h3>
                    </header>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <h3 style="width:100%;">Наши работы: </h3>
            <?php foreach($works as $work): ?>
                <article class="col-3 col-12-mobile special">
                    <a href="<?php echo Url::to(['/works/view', 'category_translit' => $work->category['translit'], 'works_translit' => $work['translit']]); ?>" class="image featured">
                        <?php $image_work = $work->getImage(); ?>
                        <img class="img-rounded" src="/<?php echo $image_work->getPath('x250'); ?>" alt="<?php echo $image_work['urlAlias']; ?>">
                        <?php if ($work->best_work): ?>
                            <i class="fa fa-thumbs-o-up"></i>
                        <?php endif; ?>
                    </a>
                    <header>
                        <h3>
                            <a href="<?php echo Url::to(['/works/view', 'category_translit' => $work->category['translit'], 'works_translit' => $work['translit']]); ?>">
                                <?php echo $work['name']; ?>
                            </a>
                        </h3>
                        <?php if ($work['price'] != 0 || $work['price'] != ''): ?>
                            <span>Цена: <?php echo Yii::$app->formatter->asCurrency($work['price']); ?></span>
                        <?php endif; ?>
                    </header>
                </article>
            <?php endforeach; ?>

            <?= LinkPager::widget([
                'pagination' => $pages,
            ]); ?>
        </div>
    <?php else: ?>
        <div class="katalog_empty">
            <h2>Каталог заполняется... </h2>
        </div>
    <?php endif; ?>
</div>