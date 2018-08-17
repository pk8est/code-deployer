<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use mdm\admin\components\Helper;
use yii\helpers\ArrayHelper;
use common\models\ProjectGroup;
use common\models\Depository;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('
$("form").on("change", "#project-repo_type", function (event){
	if(event.target.value == 1){
		$("#project-repo_id").attr("disabled", false);
		$("#project-repo_account,#project-repo_password, #project-repo_private_key").attr("disabled", true);
	}else{
		$("#project-repo_id").attr("disabled", true);
		$("#project-repo_account,#project-repo_password, #project-repo_private_key").attr("disabled", false);
	}
})
');

?>

    <div class="box-body table-responsive row">
        <div class="col-sm-6">

            <?= $form->field($model, 'repo_type')->dropDownList(array_list($model->repoTypeArr, 'name'), ['prompt' => '--']) ?>

            <?= $form->field($model, 'repo_id')->dropDownList(arr_map(Depository::find()->all(), 'id', 'address'), ['prompt' => '--', 'disabled' => true]) ?>
		
			<?php /*$form->field($model, 'repo_id')->widget(new class {
				public static function widget($config){
					$items = arr_map(Depository::find()->all(), 'id', 'address');
					return '<div class="form-inline">' . Html::activeDropDownList($config['model'], $config['attribute'], $items, 
						[
							'class' => 'form-control ',
							'prompt' => '--', 
							'disabled' => true,
							'style' => 'width: 385px',
						]) .' '. Html::activeTextInput($config['model'], 'repo_address', ['class' => 'form-control', 'style' => 'width: 400px;']) . '</div>';
				}
			}) */?>           

 
			<?= $form->field($model, 'repo_address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'repo_branch')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'repo_account')->textInput(['maxlength' => true, 'disabled' => true]) ?>

            <?= $form->field($model, 'repo_password')->textInput(['maxlength' => true, 'disabled' => true]) ?>

            <?= $form->field($model, 'repo_private_key')->textarea(['rows' => 5, 'disabled' => true]) ?>
        
        </div>
    </div>
