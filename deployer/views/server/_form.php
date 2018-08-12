<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Server */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="server-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive row">
        <div class="col-sm-6">
        <?= $form->field($model, 'room_id')->textInput() ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ssh_private_key')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'deleted_at')->textInput() ?>

        <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

		</div>
		<div class="col-sm-6">
        <?= $form->field($model, 'creater_id')->textInput() ?>

        <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'inner_ip')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->textInput() ?>

        <?= $form->field($model, 'level')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

        <?= $form->field($model, 'order')->textInput() ?>

        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
        <?= Html::a(Yii::t('app', 'Return List'), ['index'], ['class' => 'btn btn-info btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
