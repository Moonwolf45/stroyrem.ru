<?php

use yii\helpers\Url;

?>

<div class="wrapper style1">
    <div class="container">
        <div class="row gtr-200">
            <div class="col-8 col-12-mobile" id="content">
                <article id="main">
                    <header>
                        <h2><?php echo $share['name']; ?></h2>
                    </header>
                    <a class="image featured">
                        <?php $share_img = $share->getImage(); ?>
                        <img class="img-rounded" src="/<?php echo $share_img->getPath('x412'); ?>" alt="<?php echo $share_img['urlAlias']; ?>">
                    </a>
                    <section>
                        <?php echo $share['text']; ?>
                    </section>
                </article>
            </div>
            <div class="col-4 col-12-mobile" id="sidebar">
                <hr>
                <?php if(!empty($other_share)): ?>
                    <section>
                        <header>
                            <h3>Еще новости</h3>
                        </header>
                        <div class="row gtr-50">
                            <?php foreach($other_share as $the_other_share): ?>
                                <div class="col-4">
                                    <a href="#" class="image fit">
                                        <?php $other_share_img = $the_other_share->getImage(); ?>
                                        <img class="img-rounded" src="/<?php echo $other_share_img->getPath('x101'); ?>" alt="<?php echo $other_share_img['urlAlias']; ?>">
                                    </a>
                                </div>
                                <div class="col-8">
                                    <h4><?php echo $the_other_share['name']; ?></h4>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <footer>
                            <a href="<?= Url::to(['/shares/all-shares']); ?>" class="button">Все акции</a>
                        </footer>
                    </section>
                <?php endif; ?>
            </div>
        </div>
        <hr>
    </div>
</div>