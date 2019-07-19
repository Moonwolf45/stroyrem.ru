<?php

use app\components\NewsWidget;
use app\components\ReviewsWidget;
use app\components\SharesWidget;
use app\components\WorksWidget;

?>

<?php echo WorksWidget::widget(); ?>

<?php echo NewsWidget::widget(); ?>

<?php echo SharesWidget::widget(); ?>

<?php echo ReviewsWidget::widget(); ?>
