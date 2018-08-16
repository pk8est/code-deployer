<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Depository */

$this->title = Yii::t('app', 'Create Depository');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Depositories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="depository-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
