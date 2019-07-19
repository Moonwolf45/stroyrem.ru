<?php

namespace app\models;

use app\components\CachedBehavior;
use dastanaron\translit\Translit;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $name
 * @property string $translit
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $text
 */
class Pages extends ActiveRecord {

    private $_url;

    public function getUrl() {
        if ($this->_url === null)
            $this->_url = Yii::$app->urlManager->createUrl(['pages/view', 'translit' => $this->translit]);
        return $this->_url;
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'CachedBehavior' => [
                'class' => CachedBehavior::class,
                'cache_id' => [
                    'page',
                    'pages',
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
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'translit'], 'required'],
            [['text'], 'string'],
            [['name', 'translit', 'meta_keywords', 'meta_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'translit' => 'Translit',
            'meta_keywords' => 'Мета-Ключевики',
            'meta_description' => 'Мета-Описание',
            'text' => 'Контент',
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $transliterate = new Translit();
            $this->translit = $transliterate->translit(mb_strtolower($this->name), true, 'ru-en');
            return true;
        }
        return false;
    }
}
