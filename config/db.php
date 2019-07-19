<?php

    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=stroikfx_st_r',
        'username' => 'stroikfx_st_r',
        'password' => 'OF4lIy437UfyZV2Y',
        'charset' => 'utf8',
        'attributes'=>[
            PDO::ATTR_PERSISTENT => true
        ],

        'enableSchemaCache' => true,
        // Продолжительность кеширования схемы.
        'schemaCacheDuration' => 3600,
        // Название компонента кеша, используемого для хранения информации о схеме
        'schemaCache' => 'cache',
    ];