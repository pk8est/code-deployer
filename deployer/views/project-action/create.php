<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectAction */

$this->title = Yii::t('app', 'Create Project Action');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-action-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
