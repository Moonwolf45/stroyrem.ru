<?php

    use yii\helpers\Url;

?>

<nav id="nav">
    <ul>
        <li><a href="<?php echo Url::home(); ?>">Главная</a></li>
        <?php if(!empty($pages)): ?>
            <?php foreach($pages as $page): ?>
                <li>
                    <a href="<?php echo Url::to(['/pages/view', 'translit' => $page['translit']]); ?>">
                        <?php echo $page['name']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
        <li><a href="<?php echo Url::to(['/pages/our-works']); ?>">Наши работы</a></li>
        <li><a href="<?php echo Url::to(['/pages/contact']); ?>">Обратная связь</a></li>
        <li><a data-toggle="modal" data-target="#our_contacts">Контакты</a></li>
    </ul>
</nav>