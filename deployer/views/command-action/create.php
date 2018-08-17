<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CommandAction */

$this->title = Yii::t('app', 'Create Command Action');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Command Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="command-action-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
