<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "event_set".
 *
 * @property integer $id
 * @property integer $key
 * @property string $name
 */
class EventSet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_set';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'integer'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'name' => 'Name',
        ];
    }
}
