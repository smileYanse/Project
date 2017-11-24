<?php
namespace frontend\controllers;

use backend\models\Category;
use backend\models\Events;
use backend\models\EventSet;
use backend\models\EventTeam;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'main';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEvents()
    {
        $weekModels = EventSet::find()->orderBy('id DESC')->all();
        $typeModels = Category::findAll(['model'=>2]);
        $eventsModels = NULL;
        if (Yii::$app->request->isGet){


            $id = $type=$week=$status= 0;
            if (isset(Yii::$app->request->get('1')['id'])){
                $id  = Yii::$app->request->get('1')['id']?:0;
            }else{
                $type = Yii::$app->request->get('1')['type']?:0;
                $week = Yii::$app->request->get('1')['week']?:0;
                $status = Yii::$app->request->get('1')['status']?:0;
            }

            $sql = "select * from events";

            if ($type!=0){
                $sql .= " where event_type_id='$type'";
            }
            if ($week!=0){
                if ($type==0){
                    $sql .= " where event_weekday='$week'";
                }else{
                    $sql .= " and event_weekday='$week'";

                }
            }

            if ($id==0){
                $eventsModels = Events::findBySql($sql)->all();

                return $this->render('events',[
                    'weekModels'=>$weekModels,
                    'typeModels'=>$typeModels,
                    'eventsModels'=>$eventsModels,
                    'type'=>$type,
                    'week'=>$week,
                    'status'=>$status,
                    'id'=>$id
                ]);
            }else{
                $num = mt_rand(0,999);
                $time = date('YmdHis',time());
                $v_card = $time.$num;
                $eventsModel = Events::findOne($id);
                return $this->render('events_detail',[
                    'weekModels'=>$weekModels,
                    'typeModels'=>$typeModels,
                    'eventsModel'=>$eventsModel,
                    'type'=>$type,
                    'week'=>$week,
                    'status'=>$status,
                    'v_card'=>$v_card
                ]);
            }


        }




    }


    public function actionBaoMing(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        //"vcard":"20171104001159783","mobile":"18888888888","eid":"3"
        //一系类的判断
        //1,判断是否过期-活动截止
        //2,判断人数是否满-活动人数
        //3,是否已经报名-team表中是否已经存在数
        $eventId = Yii::$app->request->post('eid');
        $mobile = Yii::$app->request->post('mobile');
        $vcard = Yii::$app->request->post('vcard');

        $eventModel = Events::findOne(['id'=>$eventId]);

        //{"status":1,"message":"\u62a5\u540d\u6210\u529f\uff0c\u8bf7\u5728\u60a8\u7684\u62a5\u540d\u901a\u8fc7\u540e\u6309\u8bf4\u660e\u53c2\u52a0\u6d3b\u52a8\uff01"}

        //是否参加过
        $teamModel = EventTeam::find()->where("tel=$mobile")->where("eid=$eventId")->all();
        if ($teamModel){
            //已经存在
            return ['status'=>0,'message'=>'不能重复报名'];
        }

        //过期
        $endTime = strtotime($eventModel->event_recruit_end_time);
        if ($endTime-time()<0){
            //过期
            return ['status'=>0,'message'=>'活动报名已经截止'];
        }

        //人数
        if ($eventModel->event_headcount=0){
            return ['status'=>0,'message'=>'报名人数已满'];
        }

        //没错误
        $teamModel = new EventTeam();
        $teamModel->eid = $eventId;
        $teamModel->vcard = $vcard;
        $teamModel->tel = $mobile;
        $teamModel->uname = $mobile;
        $teamModel->uid = 0;
        $teamModel->status = 0;
        $teamModel->dtime = time();

        if ($teamModel->save()){
            //保持成功
            return ['status'=>1,'message'=>'报名成功'];
        }else{
            return ['status'=>0,'message'=>'报名失败,未知错误'];
        }




        //return Yii::$app->request->post();
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
