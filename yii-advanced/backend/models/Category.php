<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $cid
 * @property integer $pid
 * @property integer $mid
 * @property integer $model
 * @property integer $sequence
 * @property integer $show
 * @property integer $type
 * @property string $name
 * @property string $urlname
 * @property string $subname
 * @property string $image
 * @property string $class_tpl
 * @property string $content_tpl
 * @property integer $page
 * @property string $keywords
 * @property string $description
 * @property string $seo_content
 * @property string $content_order
 * @property integer $lang
 * @property string $content
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'mid', 'model', 'sequence', 'show', 'type', 'page', 'lang'], 'integer'],
            [['seo_content', 'content'], 'string'],
            [['name', 'urlname', 'subname', 'image', 'class_tpl', 'content_tpl', 'keywords', 'description', 'content_order'], 'string', 'max' => 250],
            [['urlname'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => 'Cid',
            'pid' => 'Pid',
            'mid' => 'Mid',
            'model' => 'Model',
            'sequence' => 'Sequence',
            'show' => 'Show',
            'type' => 'Type',
            'name' => 'Name',
            'urlname' => 'Urlname',
            'subname' => 'Subname',
            'image' => 'Image',
            'class_tpl' => 'Class Tpl',
            'content_tpl' => 'Content Tpl',
            'page' => 'Page',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'seo_content' => 'Seo Content',
            'content_order' => 'Content Order',
            'lang' => 'Lang',
            'content' => 'Content',
        ];
    }
}
