<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CommandScript */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Command Script',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Command Scripts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="command-script-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
