<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $level
 * @property integer $parent_id
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%region}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'parent_id'], 'integer'],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '表id'),
            'name' => Yii::t('app', '地区名称'),
            'level' => Yii::t('app', '地区等级 分省市县区'),
            'parent_id' => Yii::t('app', '父id'),
        ];
    }
    
    public static function getInfoById($id) {
        $row = self::find()->where([
            'id' => $id
        ])->one();
        return $row;
    }
    
    public static function getListsByParentId($parentid) {
        $cacheKey = "region-childs-" . $parentid;
        $cache = Yii::$app->cache->get($cacheKey);
        if (!empty($cache)) {
            return $cache;
        }
        
        $row = self::find()->where([
            'parent_id' => $parentid
        ])->all();
        
        Yii::$app->cache->set($cacheKey, $row);
        
        return $row;
    }
    
}
