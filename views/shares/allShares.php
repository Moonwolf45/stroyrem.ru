<?php

    use yii\helpers\Url;
    use yii\widgets\LinkPager;

?>

<div class="container bg_white">
    <?php if(!empty($shares)): ?>
        <div class="wrapper style1">
            <section id="features" class="special">
                <div class="row">
                    <?php foreach($shares as $share_one): ?>
                        <article class="col-4 col-12-mobile special">
                            <a href="<?php echo Url::to(['/shares/view', 'translit' => $share_one['translit']]); ?>" class="image featured">
                                <?php $image_share = $share_one->getImage(); ?>
                                <img class="img-rounded" src="/<?php echo $image_share->getPath('x305'); ?>" alt="<?php echo $image_share['urlAlias']; ?>">
                            </a>
                            <header>
                                <p>Дата: <?php echo Yii::$app->formatter->asDate($share_one['created_at']); ?></p>
                                <h3>
                                    <a href="<?php echo Url::to(['/shares/view', 'translit' => $share_one['translit']]); ?>">
                                        <?php echo $share_one['name']; ?>
                                    </a>
                                </h3>
                            </header>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    <?php else: ?>
        <h3>У вас нет акций.</h3>
    <?php endif; ?>

    <?= LinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>