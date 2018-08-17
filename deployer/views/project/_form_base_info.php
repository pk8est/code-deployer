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

?>

    <div class="box-body table-responsive row">
        <div class="col-sm-6">
            <?= $form->field($model, 'project_group_id')->dropdownList(
                ArrayHelper::map(ProjectGroup::find()->select(['id', 'name'])->all(), 'id', 'name')
            ) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList(array_list($model->statusArr, 'name')) ?>

            <!-- <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?> -->

            <!-- <?= $form->field($model, 'order')->textInput() ?> -->

        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>
        </div>
    </div>
