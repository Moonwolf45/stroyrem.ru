<?php

    use yii\helpers\Url;

?>

<div class="wrapper style1">
    <div class="container">
        <div class="row gtr-200">
            <div class="col-8 col-12-mobile" id="content">
                <article id="main">
                    <header>
                        <h2><?php echo $news['name']; ?></h2>
                    </header>
                    <a class="image featured">
                        <?php $news_img = $news->getImage(); ?>
                        <img class="img-rounded" src="/<?php echo $news_img->getPath('x412'); ?>" alt="<?php echo $news_img['urlAlias']; ?>">
                    </a>
                    <section>
                        <?php echo $news['text']; ?>
                    </section>
                </article>
            </div>
            <div class="col-4 col-12-mobile" id="sidebar">
                <hr>
                <?php if(!empty($other_news)): ?>
                    <section>
                        <header>
                            <h3>Еще новости</h3>
                        </header>
                        <div class="row gtr-50">
                            <?php foreach($other_news as $the_other_news): ?>
                                <div class="col-4">
                                    <a href="#" class="image fit">
                                        <?php $other_news_img = $the_other_news->getImage(); ?>
                                        <img class="img-rounded" src="/<?php echo $other_news_img->getPath('x101'); ?>" alt="<?php echo $other_news_img['urlAlias']; ?>">
                                    </a>
                                </div>
                                <div class="col-8">
                                    <p>Дата: <?php echo Yii::$app->formatter->asDate($the_other_news['created_at']); ?></p>
                                    <h4><?php echo $the_other_news['name']; ?></h4>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <footer>
                            <a href="<?= Url::to(['/news/all-news']); ?>" class="button">Все новости</a>
                        </footer>
                    </section>
                <?php endif; ?>
            </div>
        </div>
        <hr>
    </div>
</div>