<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\CommandScript */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="command-script-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive row">
        <div class="col-sm-6">
        <?= $form->field($model, 'creater_id')->textInput() ?>

        <?= $form->field($model, 'script')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'status')->textInput() ?>

        <?= $form->field($model, 'is_local')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

        <?= $form->field($model, 'order')->textInput() ?>

		</div>
		<div class="col-sm-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'runner')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'deleted_at')->textInput() ?>

        <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

        </div>
    </div>
    <div class="box-footer">
        <?= Helper::checkRoute('view') && $model->getPrimaryKey() ? Html::a(Yii::t('app', 'View'), ['view',  'id' => $model->id], ['class' => 'btn btn-success btn-flat']) : '' ?>
        <?= Helper::checkRoute('index') ? Html::a(Yii::t('app', 'Return List'), ['index'], ['class' => 'btn btn-info btn-flat']) : '' ?>
        <?= Helper::checkRoute('update') ? Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-danger btn-flat']) : '' ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
