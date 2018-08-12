<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mdm\admin\components\Helper;
use yii\helpers\ArrayHelper;
use common\models\ProjectGroup;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive row">
        <div class="col-sm-6">
            <?= $form->field($model, 'project_group_id')->dropdownList(
                ArrayHelper::map(ProjectGroup::find()->select(['id', 'name'])->all(), 'id', 'name')
            ) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'repo_type')->textInput() ?>

            <?= $form->field($model, 'repo_address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'repo_account')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'repo_password')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'repo_private_key')->textInput(['maxlength' => true]) ?>
        
        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'repo_branch')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->textInput() ?>

            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'order')->textInput() ?>

            <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="box-footer">
        <?= Helper::checkRoute('view') && $model->id ? Html::a(Yii::t('app', 'View'), ['view', 'id' => $model->id], ['class' => 'btn btn-success btn-flat']) : '' ?>
        <?= Helper::checkRoute('index') ? Html::a(Yii::t('app', 'Return List'), ['index'], ['class' => 'btn btn-info btn-flat']) : '' ?>
        <?= Helper::checkRoute('update') ? Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-danger btn-flat']) : '' ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
