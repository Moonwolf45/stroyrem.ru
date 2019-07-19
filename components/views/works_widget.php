<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if (!empty($works_end_to_ten)): ?>
    <section id="banner">
        <header>
            <h2>Лучшие проекты</h2>
        </header>
    </section>

    <section class="carousel_project">
        <div class="reel">
            <?php foreach($works_end_to_ten as $work): ?>
                <article>
                    <a href="<?php echo Url::to(['/works/view', 'category_translit' => $work->category['translit'], 'works_translit' => $work['translit']]); ?>" class="image featured">
                        <?php $image_work_widget = $work->getImage(); ?>
                        <?php echo Html::img('@web/' . $image_work_widget->getPath('x250'), ['class' => 'img-rounded', 'alt' => $image_work_widget['urlAlias']]); ?>
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
        </div>
    </section>
<?php endif; ?>