<?php

namespace app\models;

use app\components\CachedBehavior;
use dastanaron\translit\Translit;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $created_at
 * @property string $name
 * @property string $translit
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $text
 */
class News extends ActiveRecord {

    public $image;

    private $_url;

    public function getUrl() {
        if ($this->_url === null)
            $this->_url = Yii::$app->urlManager->createUrl(['news/view', 'translit' => $this->translit]);
        return $this->_url;
    }

    public function behaviors() {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],
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
                    'news',
                    'other_news',
                    'news_query',
                    'news_tree_end',
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
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['name', 'translit', 'meta_keywords', 'meta_description'], 'string', 'max' => 255],

            [['image'], 'file', 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'name' => 'Название',
            'translit' => 'Translit',
            'meta_keywords' => 'Мета-Ключевики',
            'meta_description' => 'Мета-Описание',
            'text' => 'Контент',

            'image' => 'Картинка',
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

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        $this->image = UploadedFile::getInstance($this, 'image');
        if ($this->image->name != '') {
            $this->upload();
        }
        unset($this->image);
    }

    public function upload() {
        if ($this->validate()) {
            $name_image = time() . '.' . $this->image->extension;
            $new_name_image = 'images/temp_files/' . $this->image->baseName . '.' . $this->image->extension;
            $path = 'images/temp_files/' . $name_image;
            $this->image->saveAs($path);
            shell_exec('convert ' . $path . ' -auto-orient ' . $new_name_image);

            $this->attachImage($new_name_image, true);
            @unlink($path);
            @unlink($new_name_image);
            return true;
        } else {
            return false;
        }
    }
}
