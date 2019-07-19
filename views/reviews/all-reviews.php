<?php

    use yii\widgets\LinkPager;

?>

<div class="container bg_white">
    <?php if (!empty($reviews)): ?>
        <?php foreach ($reviews as $review): ?>
            <blockquote>
                <p>Оцена: <?php $end_rest = 5 - $review['rating']; ?>
                    <?php for ($a = 0; $a < $review['rating']; $a++): ?>
                        <i class="fa fa-home fa-active"></i>
                    <?php endfor; ?>

                    <?php if($end_rest != 0): ?>
                        <?php for ($b = 0; $b < $end_rest; $b++): ?>
                            <i class="fa fa-home"></i>
                        <?php endfor; ?>
                    <?php endif; ?><br>

                    <?php echo $review['text']; ?></p>
                <footer><?php echo $review['name']; ?></footer>
            </blockquote>
        <?php endforeach; ?>
    <?php else: ?>
        <h3>У вас нет отзывов.</h3>
    <?php endif; ?>


    <?= LinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>