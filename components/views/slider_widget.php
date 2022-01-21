<?php

use yii\helpers\Html;
use yii\web\View;

if (!empty($slider)): ?>
    <div class="slider">
        <?php foreach($slider as $slide): ?>
            <div class="item">
<!--                --><?php //$image_slide_widget = $slide->getImage(); ?>
<!--                --><?php //echo Html::img('@web/' . $image_slide_widget->getPath('x655'), ['class' => 'slide_img', 'alt' => $image_slide_widget['urlAlias']]); ?>
                <?php if ($slide['title'] != '' || $slide['content'] != ''): ?>
                    <div class="caption">
                        <h4><?php echo $slide['title']; ?></h4>
                        <p><?php echo $slide['content']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif;

$script = <<< JS
    $('.slider').slick({
        variableWidth: true,
        centerMode: true,
        centerPadding: '20px',
        dots: true, 
        infinite: true, 
        autoplay: true, 
        autoplaySpeed: 5000, 
        speed: 1500, 
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<a class="left carousel-control owl-prev" role="button"><span class="glyphicon glyphicon-chevron-left"></span></a>',
        nextArrow: '<a class="right carousel-control owl-next" role="button"><span class="glyphicon glyphicon-chevron-right"></span></a>',
    });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, View::POS_READY);

?>
