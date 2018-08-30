<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Server;

/* @var $this yii\web\View */
/* @var $model common\models\ServerGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="server-group-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive row">
        <div class="col-sm-6">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'servers')->widget(Select2::className(), [
			//'name' => 'server_ids',
			'data' => arr_map(Server::findAll(['status' => Server::STATUS_NORMAL]), 'id', 'name'),
			'options' => [
				'multiple' => 'true'
			],
		]) ?>

		</div>
		<div class="col-sm-6">

        <?= $form->field($model, 'status')->dropDownList(array_list($model->statusArr, 'name')) ?>

        <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
        <?= Html::a(Yii::t('app', 'Return List'), ['index'], ['class' => 'btn btn-info btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
