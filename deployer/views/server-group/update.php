<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServerGroup */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Server Group',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Server Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="server-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
