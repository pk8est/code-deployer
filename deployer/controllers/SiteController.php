<?php
namespace deployer\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use deployer\events\Events;
use deployer\events\LoginEvent;
use deployer\events\LogoutEvent;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'language', 'layout', 'skin'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

	public function init(){
		parent::init();
		$this->on(Events::EVENT_USER_LOGIN, ['deployer\events\UserEventHandler', 'login']);
		$this->on(Events::EVENT_USER_LOGOUT, ['deployer\events\UserEventHandler', 'logout']);
	}

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			$this->trigger(Events::EVENT_USER_LOGIN, new LoginEvent(true, Yii::$app->user->id, $model->username));
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
		if(Yii::$app->request->isPost){
			$this->trigger(Events::EVENT_USER_LOGIN, new LoginEvent(false, 0, $model->username));

		}
		
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
		$this->trigger(Events::EVENT_USER_LOGOUT, new LogoutEvent(Yii::$app->user->id, Yii::$app->user->identity->username));
        Yii::$app->user->logout();
        return $this->goHome();
    }
	
	public function actionLanguage(){
        $language=  Yii::$app->request->get('lang');
        if(isset($language)){
            Yii::$app->session['language']=$language;
        }
		$this->redirect(Yii::$app->request->referrer);
		
    }

    public function actionLayout(){
        Yii::$app->session['page-layout'] = Yii::$app->request->get('layout');
        $this->redirect(Yii::$app->request->referrer);
    }

    public function actionSkin(){
        Yii::$app->session['skin-style'] = Yii::$app->request->get('style');
        $this->redirect(Yii::$app->request->referrer);
    }

}
