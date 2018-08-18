<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectAction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-action-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive row">
        <div class="col-sm-6">
        <?= $form->field($model, 'project_id')->textInput() ?>

        <?= $form->field($model, 'order')->textInput() ?>

		</div>
		<div class="col-sm-6">
        <?= $form->field($model, 'action_id')->textInput() ?>

        </div>
    </div>
    <div class="box-footer">
        <?= Helper::checkRoute('view') && $model->getPrimaryKey() ? Html::a(Yii::t('app', 'View'), ['view',  'id' => $model->id], ['class' => 'btn btn-success btn-flat']) : '' ?>
        <?= Helper::checkRoute('index') ? Html::a(Yii::t('app', 'Return List'), ['index'], ['class' => 'btn btn-info btn-flat']) : '' ?>
        <?= Helper::checkRoute('update') ? Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-danger btn-flat']) : '' ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
