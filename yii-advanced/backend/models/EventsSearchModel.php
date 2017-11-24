<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use yii\base\Model;

class EventsSearchModel extends Events {

    public $event_name;

    public function search($params) {
        $query = Events::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'event_name' => $this->event_name,
        ]);
        return $dataProvider;
    }

}
