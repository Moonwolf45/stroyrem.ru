<?php

use yii\helpers\Html;
use yii\web\View;

?>

<div class="wrapper style1">
    <div class="container">
        <div class="row gtr-50">
            <article id="main">
                <header>
                    <h2><?php echo $works['name']; ?></h2>
                </header>
                <?php $works_gallery = $works->getImages(); ?>
                <div id="gallery" class="owl-carousel owl-theme">
                    <?php foreach($works_gallery as $works_image): ?>
                        <?php echo Html::img('@web/' . $works_image->getPath('x400'), ['class' => 'img-rounded', 'alt' => $works_image['urlAlias']]); ?>
                    <?php endforeach; ?>
                </div>
                <section>
                    <?php echo $works['text']; ?>
                </section>
                <section>
                    <?php if ($works['price'] != 0 || $works['price'] != ''): ?>
                        <span>Цена: <?php echo Yii::$app->formatter->asCurrency($works['price']); ?></span>
                    <?php endif; ?>
                </section>
            </article>
        </div>
        <hr>
    </div>
</div>

<?php

$script = <<< JS
    $('.owl-carousel').slick({
        variableWidth: true,
        centerMode: true,
        centerPadding: '20px',
        dots: true, 
        infinite: true, 
        autoplay: true, 
        autoplaySpeed: 2000, 
        speed: 1000, 
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [ //Адаптация в зависимости от разрешения экрана
            {
                breakpoint: 890,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 570,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
JS;

//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, View::POS_READY);

?>
