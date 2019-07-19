<?php

    use yii\helpers\Url;
    use yii\widgets\LinkPager;

?>

<div class="container bg_white">
    <?php if(!empty($news)): ?>
        <div class="wrapper style1">
            <section id="features" class="special">
                <div class="row">
                    <?php foreach($news as $news_one): ?>
                        <article class="col-4 col-12-mobile special">
                            <a href="<?php echo Url::to(['/news/view', 'translit' => $news_one['translit']]); ?>" class="image featured">
                                <?php $image_news = $news_one->getImage(); ?>
                                <img class="img-rounded" src="/<?php echo $image_news->getPath('x305'); ?>" alt="<?php echo $image_news['urlAlias']; ?>">
                            </a>
                            <header>
                                <p>Дата: <?php echo Yii::$app->formatter->asDate($news_one['created_at']); ?></p>
                                <h3>
                                    <a href="<?php echo Url::to(['/news/view', 'translit' => $news_one['translit']]); ?>">
                                        <?php echo $news_one['name']; ?>
                                    </a>
                                </h3>
                            </header>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    <?php else: ?>
        <h3>У вас нет новостей.</h3>
    <?php endif; ?>

    <?= LinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>