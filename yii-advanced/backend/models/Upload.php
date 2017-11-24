<?php

namespace backend\models;


class Upload extends \yii\base\Model {
    
    public $file;
    
    public function rules() {
        return [
            [['file'], 'required']
        ];
        
    }
}
