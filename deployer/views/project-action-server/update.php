<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectActionServer */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Project Action Server',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Action Servers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-action-server-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
