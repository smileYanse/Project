<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "event_team".
 *
 * @property integer $id
 * @property integer $eid
 * @property integer $uid
 * @property string $uname
 * @property string $vcard
 * @property string $tel
 * @property string $table
 * @property integer $fid
 * @property string $vtime
 * @property integer $vzt
 * @property integer $status
 * @property string $ip
 * @property integer $dtime
 */
class EventTeam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eid', 'uid', 'fid', 'vzt', 'status', 'dtime'], 'integer'],
            [['uname', 'vcard'], 'string', 'max' => 250],
            [['tel'], 'string', 'max' => 100],
            [['table'], 'string', 'max' => 30],
            [['vtime'], 'string', 'max' => 20],
            [['ip'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'eid' => 'Eid',
            'uid' => 'Uid',
            'uname' => 'Uname',
            'vcard' => 'Vcard',
            'tel' => 'Tel',
            'table' => 'Table',
            'fid' => 'Fid',
            'vtime' => 'Vtime',
            'vzt' => 'Vzt',
            'status' => 'Status',
            'ip' => 'Ip',
            'dtime' => 'Dtime',
        ];
    }
}
