<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CommandAction */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Command Action',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Command Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="command-action-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
