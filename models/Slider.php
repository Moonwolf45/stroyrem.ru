<?php

namespace app\models;

use app\components\CachedBehavior;
use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string $image
 * @property string $title
 * @property string $content
 */
class Slider extends ActiveRecord {

    public $image;

    public function behaviors() {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],
            'CachedBehavior' => [
                'class' => CachedBehavior::class,
                'cache_id' => [
                    'slider',
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
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['title'], 'required'],
            [['title', 'content'], 'string'],

            [['image'], 'file', 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'image' => 'Картинка',
            'title' => 'Название',
            'content' => 'Надпись',
        ];
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
