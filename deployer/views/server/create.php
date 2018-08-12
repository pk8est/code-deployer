<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Server */

$this->title = Yii::t('app', 'Create Server');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
