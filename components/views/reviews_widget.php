<?php

use yii\helpers\Url;
use yii\web\View;

?>

<div class="wrapper style1">
    <section id="features" class="container special">
        <header>
            <h2>Отзывы</h2>
        </header>
        <?php if(!empty($reviews)): ?>
            <div id="reviewsCarousel" class="owl-carousel">
                <?php foreach($reviews as $review): ?>
                    <article>
                        <blockquote>
                            <p>Оценка: <?php $end_rest = 5 - $review['rating']; ?>
                                <?php for ($a = 0; $a < $review['rating']; $a++): ?>
                                    <i class="fa fa-home fa-active"></i>
                                <?php endfor; ?>

                                <?php if($end_rest != 0): ?>
                                    <?php for ($b = 0; $b < $end_rest; $b++): ?>
                                        <i class="fa fa-home"></i>
                                    <?php endfor; ?>
                                <?php endif; ?><br>

                                <?php
                                $text_count = iconv_strlen($review['text']);
                                if ($text_count > 250) {
                                    $text = mb_strimwidth($review['text'], 0, 240, "...");
                                } else {
                                    $text = $review['text'];
                                }
                                ?>

                                <?php echo $text; ?></p>
                            <footer><?php echo $review['name']; ?></footer>
                        </blockquote>
                    </article>
                <?php endforeach; ?>
            </div>
            <footer>
                <a href="<?= Url::to(['/reviews/all-reviews']); ?>" class="button">Все отзывы</a>
                <a href="<?= Url::to(['/reviews/create-review']); ?>" class="button">Написать отзыв</a>
            </footer>
        <?php else: ?>
            <footer>
                <a href="<?= Url::to(['/reviews/create-review']); ?>" class="button">Написать отзыв</a>
            </footer>
        <?php endif; ?>
    </section>
</div>

<?php

$script = <<< JS
    $('.owl-carousel').slick({
        dots: false, // Отключаем точки
        infinite: true, // Зацикливаем слайдер
        autoplay: true, // Автозапуск слайдера
        autoplaySpeed: 5000, // Время смены слайда
        speed: 1500, // Время движения слайда
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: '<button type="button" class="owl-prev"><i class="fa fa-arrow-circle-o-left"></i></button>',
        nextArrow: '<button type="button" class="owl-next"><i class="fa fa-arrow-circle-o-right"></i></button>',
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
