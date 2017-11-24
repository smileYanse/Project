<?php

namespace backend\controllers;
use backend\models\Events;
use yii\web\Controller;

class EventsController extends  Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionAdd() {

        $model = new Events();

        if (\Yii::$app->request->isPost){
            if ($model->load(\Yii::$app->request->post())&&$model->validate()){

                $events = \Yii::$app->request->post('Events');
                $model->event_area = $events['event_province'].','.$events['event_city'].','.$events['event_district'];

                $model->save();

                return $this->goBack('index');
            }
        }

        return $this->render('add', [
            'model' => $model
        ]);
    }
    
    public function actionView() {
        $event = Events::findOne(\Yii::$app->request->get('id'));
        return $this->render('add',['model'=>$event]);
    }

    public function actionChange() {
        $event = Events::findOne(\Yii::$app->request->get('id'));
        if ($event->event_state=='yes'){
            $event->event_state = 'no';
        }else{
            $event->event_state = 'yes';
        }
        $event->update(FALSE);
        return $this->redirect(['events/index']);
    }

    public function actionDelete() {
        $event = Events::findOne(\Yii::$app->request->get('id'));
        $event->delete();
        return $this->goBack('index');
    }

}
