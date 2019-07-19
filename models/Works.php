<?php

namespace app\models;

use app\components\CachedBehavior;
use dastanaron\translit\Translit;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "works".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $translit
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $text
 * @property string $price
 */
class Works extends ActiveRecord {

    public $image;
    public $gallery;

    private $_url;

    public function getUrl() {
        if ($this->_url === null)
            $this->_url = Yii::$app->urlManager->createUrl(['works/view', 'category_translit' => $this->category->translit, 'works_translit' => $this->translit]);
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
                    'works_query',
                    'works',
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
        return 'works';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id'], 'integer'],
            [['text'], 'string'],
            [['price'], 'number'],
            [['name', 'translit', 'meta_keywords', 'meta_description'], 'string', 'max' => 255],
            ['best_work', 'boolean', 'trueValue' => true, 'falseValue' => false],

            [['image'], 'file', 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 4],
            [['gallery'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 12, 'maxSize' => 1024 * 1024 * 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'name' => 'Название',
            'translit' => 'Translit',
            'meta_keywords' => 'Мета-Ключевики',
            'meta_description' => 'Мета-Описание',
            'text' => 'Контент',
            'price' => 'Цена',
            'best_work' => 'Лучший проект',

            'image' => 'Основная картинка',
            'gallery' => 'Галлерея',
        ];
    }

    public function getCategory() {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
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

        $this->gallery = UploadedFile::getInstances($this, 'gallery');
        $this->uploadGallery();
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

    public function uploadGallery() {
        if ($this->validate()) {
            foreach ($this->gallery as $file) {
                $name_image = time()-rand(1, 12) . '.' . $file->extension;
                $new_name_image = 'images/temp_files/' . $file->baseName . '.' . $file->extension;
                $path = 'images/temp_files/' . $name_image;
                $file->saveAs($path);
                shell_exec('convert ' . $path . ' -auto-orient ' . $new_name_image);

                $this->attachImage($new_name_image, true);
                @unlink($path);
                @unlink($new_name_image);
            }
            return true;
        } else {
            return false;
        }
    }
}
