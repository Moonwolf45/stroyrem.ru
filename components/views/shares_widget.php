<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if (!empty($shares_two_end)): ?>
    <div class="wrapper style1">
        <section id="features" class="container special">
            <header>
                <h2>Акции</h2>
            </header>
            <div class="row">
                <?php foreach($shares_two_end as $share): ?>
                    <article class="col-4 col-12-mobile special">
                        <a href="<?php echo Url::to(['/shares/view', 'translit' => $share['translit']]); ?>" class="image featured">
                            <?php $image_shares_widget = $share->getImage(); ?>
                            <?php echo Html::img('@web/' . $image_shares_widget->getPath('x305'), ['class' => 'slide_img', 'alt' => $image_shares_widget['urlAlias']]); ?>
                        </a>
                        <header>
                            <h3>
                                <a href="<?php echo Url::to(['/shares/view', 'translit' => $share['translit']]); ?>">
                                    <?php echo $share['name']; ?>
                                </a>
                            </h3>
                        </header>
                    </article>
                <?php endforeach; ?>
            </div>
            <footer>
                <a href="<?= Url::to(['/shares/all-shares']); ?>" class="button">Все акции</a>
            </footer>
        </section>
    </div>
<?php endif; ?>
