<?php

namespace app\models;

use app\components\CachedBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $rating
 * @property bool $status
 */

class Reviews extends ActiveRecord {

    public function behaviors() {
        return [
            'CachedBehavior' => [
                'class' => CachedBehavior::class,
                'cache_id' => [
                    'reviews_query',
                    'reviews',
                    'dataProvider',
                    'model',
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'rating', 'text'], 'required'],
            [['text'], 'string'],
            ['rating', 'in', 'range' => [1, 2, 3, 4, 5]],
            [['name'], 'string', 'max' => 255],
            ['status', 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'text' => 'Отзыв',
            'rating' => 'Оценка',
            'status' => 'Статус',
        ];
    }
}
