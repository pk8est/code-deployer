<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectGroup */

$this->title = Yii::t('app', 'Create Project Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-group-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
