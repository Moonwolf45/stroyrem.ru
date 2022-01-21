<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 28.11.2018
 * Time: 21:30
 */

namespace app\components;


use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class CachedBehavior extends Behavior {

    public $cache_id;

    public function events() {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'deleteCache',
            ActiveRecord::EVENT_AFTER_UPDATE => 'deleteCache',
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteCache',
        ];
    }

    public function deleteCache() {
        foreach ($this->cache_id as $id){
            Yii::$app->cache->delete($id);
        }
    }

}