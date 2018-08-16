<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CommandScript */

$this->title = Yii::t('app', 'Create Command Script');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Command Scripts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="command-script-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
