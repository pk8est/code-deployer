<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServerRoom */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Server Room',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Server Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="server-room-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
