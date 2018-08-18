<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectActionServer */

$this->title = Yii::t('app', 'Create Project Action Server');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Action Servers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-action-server-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
