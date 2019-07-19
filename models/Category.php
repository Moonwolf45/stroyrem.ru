<?php

namespace app\models;

use app\components\CachedBehavior;
use dastanaron\translit\Translit;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $translit
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $text
 */
class Category extends ActiveRecord {

    public $image;
    public $background;

    private $_url;

    public function getUrl() {
        if ($this->_url === null)
            $this->_url = Yii::$app->urlManager->createUrl(['category/view', 'translit' => $this->translit]);
        return $this->_url;
    }

    /**
     * @return array
     */
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
                    'glav_category',
                    'categorys',
                    'categories',
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
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'required'],
            [['text'], 'string'],
            [['name', 'translit', 'meta_keywords', 'meta_description'], 'string', 'max' => 255],

            [['image'], 'file', 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 4],
            [['background'], 'file', 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительсккая категория',
            'name' => 'Название',
            'translit' => 'Translit',
            'meta_keywords' => 'Мета-Ключевики',
            'meta_description' => 'Мета-Описание',
            'text' => 'Контент',

            'image' => 'Картинка',
            'background' => 'Фон',
        ];
    }

    public function getCategory() {
        return $this->hasOne(Category::class, ['id' => 'parent_id']);
    }

    public function getWorks() {
        return $this->hasMany(Works::class, ['category_id' => 'id']);
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

        $this->background = UploadedFile::getInstance($this, 'background');
        if ($this->background->name != '') {
            $this->uploadBackground();
        }
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

    public function uploadBackground() {
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
