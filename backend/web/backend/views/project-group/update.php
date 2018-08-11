<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectGroup */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Project Group',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
