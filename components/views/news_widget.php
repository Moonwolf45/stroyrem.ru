<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if(!empty($news_tree_end)): ?>
    <div class="wrapper style1">
        <section id="features" class="container special">
            <header>
                <h2>Новости</h2>
            </header>
            <div class="row">
                <?php foreach($news_tree_end as $news): ?>
                    <article class="col-4 col-12-mobile special">
                        <a href="<?php echo Url::to(['/news/view', 'translit' => $news['translit']]); ?>" class="image featured">
                            <?php $image_news_widget = $news->getImage(); ?>
                            <?php echo Html::img('@web/' . $image_news_widget->getPath('x305'), ['class' => 'slide_img', 'alt' => $image_news_widget['urlAlias']]); ?>
                        </a>
                        <header>
                            <p>Дата: <?php echo Yii::$app->formatter->asDate($news['created_at']); ?></p>
                            <h3>
                                <a href="<?php echo Url::to(['/news/view', 'translit' => $news['translit']]); ?>">
                                    <?php echo $news['name']; ?>
                                </a>
                            </h3>
                        </header>
                    </article>
                <?php endforeach; ?>
            </div>
            <footer>
                <a href="<?= Url::to(['/news/all-news']); ?>" class="button">Все новости</a>
            </footer>
        </section>
    </div>
<?php endif; ?>
