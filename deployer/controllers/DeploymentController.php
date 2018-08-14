<?php
namespace deployer\controllers;

use Yii;
use yii\web\NotFountHttpException;
use common\models\Project;
use deployer\services\DeployService;

class DeploymentController extends BaseController{
	

	public function actionDeploy($id){
		Yii::$app->deployer->deploy($this->findModel($id));
	}
	
	protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
