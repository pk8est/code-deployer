<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServerGroup */

$this->title = Yii::t('app', 'Create Server Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Server Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-group-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
