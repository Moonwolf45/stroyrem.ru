<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180820_182501_slider
 */
class m180820_182501_slider extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('slider', [
            'id' => Schema::TYPE_PK,
            'image' => Schema::TYPE_STRING . ' NOT NULL',
            'title' => Schema::TYPE_TEXT . ' NULL',
            'content' => Schema::TYPE_TEXT . ' NULL',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('slider');
    }
}
