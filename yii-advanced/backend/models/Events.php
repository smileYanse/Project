<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%events}}".
 *
 * @property integer $id
 * @property string $event_name
 * @property string $event_thumb
 * @property integer $event_type_id
 * @property integer $event_weekday
 * @property string $event_area
 * @property string $event_fee_type_id
 * @property string $event_start_time
 * @property string $event_end_time
 * @property integer $event_headcount
 * @property integer $event_service_hours
 * @property string $event_contact
 * @property string $event_contact_phone
 * @property string $event_place
 * @property string $event_recruit_type
 * @property string $event_approve
 * @property string $event_state
 * @property string $event_recruit_end_time
 * @property string $event_introduction
 * @property string $event_description
 * @property string $event_condition
 * @property string $event_attention
 * @property string $event_fee
 */
class Events extends \yii\db\ActiveRecord {

    public $event_province;
    public $event_city;
    public $event_district;
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%events}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['event_type_id', 'event_weekday', 'event_headcount', 'event_service_hours'], 'integer'],
            [['event_start_time', 'event_end_time', 'event_recruit_end_time'], 'safe'],
            [['event_introduction', 'event_description', 'event_condition', 'event_attention'], 'string'],
            [['event_fee'], 'number'],
            [['event_name', 'event_thumb', 'event_fee_type_id'], 'string', 'max' => 255],
            [['event_area'], 'string', 'max' => 30],
            [['event_contact'], 'string', 'max' => 40],
            [['event_contact_phone', 'event_recruit_type', 'event_state'], 'string', 'max' => 20],
            [['event_place'], 'string', 'max' => 60],
            [['event_approve'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'event_name' => '活动名称',
            'event_thumb' => '缩略图',
            'event_type_id' => '活动的分类',
            'event_weekday' => '日期归档',
            'event_area' => '地区',
            'event_fee_type_id' => 'Event Fee Type ID',
            'event_start_time' => '活动开始时间',
            'event_end_time' => '活动结束时间',
            'event_headcount' => '招募人数',
            'event_service_hours' => '服务小时',
            'event_contact' => '联系人',
            'event_contact_phone' => ' 联系人号码',
            'event_place' => '集合地点',
            'event_recruit_type' => '招募类型',
            'event_approve' => '审批',
            'event_state' => '招募状态',
            'event_recruit_end_time' => '招募结束时间',
            'event_introduction' => '活动说明',
            'event_description' => '活动描述',
            'event_condition' => '参加条件',
            'event_attention' => '注意事项',
            'event_fee' => 'Event Fee',
        ];
    }
    
    
    public function getProvinces() {
        $cacheKey = "all_provices";
        $cache = Yii::$app->cache->get($cacheKey);
        if (!empty($cache)) {
            return $cache;
        }
        
        $result = ['' => '请选择'];
        $row = Region::getListsByParentId(0);
        if (!empty($row)) {
            foreach ($row as $k => $v) {
                $result[$v['id']] = $v['name'];
            }
        }
        
        Yii::$app->cache->set($cacheKey, $result);
        return $result;
    }

    public function getWeekDay(){
        $row =  EventSet::find()->all();
         if (!empty($row)) {
            foreach ($row as $k => $v) {
                $result[$v['id']] = $v['name'];
            }
        }
        return $result;
    }

    public function getEventTypes(){
        $row = Category::find()->where(['model'=>2])->all();
        if (!empty($row)) {
            foreach ($row as $k => $v) {
                $result[$v['cid']] = $v['name'];
            }
        }
        return $result;
    }
    
    
    public function getCities() {
        
    }
    
    public function getDistrict() {
        
    }

}
