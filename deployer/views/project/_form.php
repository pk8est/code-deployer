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

<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#depository" data-toggle="tab"><span class="fa fa-hdd-o"></span><?= Yii::t("app", "Depository") ?></a></li>
		<li><a href="#base-info" data-toggle="tab"><span class="fa fa-hdd-o"></span><?= Yii::t("app", "Project Info") ?></a></li>
		<li><a href="#other" data-toggle="tab"><span class="fa fa-hdd-o"></span><?= Yii::t("app", "Other") ?></a></li>
	</ul>
    <?php $form = ActiveForm::begin(); ?>
	<div class="tab-content">
        <div class="tab-pane active" id="depository">
			<?= $this->render('_form_depository', ['model' => $model, 'form' => $form]) ?>
		</div>
        <div class="tab-pane" id="base-info">
			<?= $this->render('_form_base_info', ['model' => $model, 'form' => $form]) ?>
		</div>
        <div class="tab-pane" id="other">Other</div>
	</div>
    <div class="box-footer">
	<?= $form->errorSummary($model) ?>
        <?= Helper::checkRoute('view') && $model->id ? Html::a(Yii::t('app', 'View'), ['view', 'id' => $model->id], ['class' => 'btn btn-success btn-flat']) : '' ?>
        <?= Helper::checkRoute('index') ? Html::a(Yii::t('app', 'Return List'), ['index'], ['class' => 'btn btn-info btn-flat']) : '' ?>
        <?= Helper::checkRoute('update') ? Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-danger btn-flat']) : '' ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
