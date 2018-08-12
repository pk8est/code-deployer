<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-group-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive row">

        <div class="col-sm-6">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropdownList(ArrayHelper::map($model::$statusArr, 'value', 'name')) ?>
        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'order')->textInput() ?>

            <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>
        </div>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>

        <?= Html::a(Yii::t('app', 'Return List'), ['index'], ['class' => 'btn btn-info btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
