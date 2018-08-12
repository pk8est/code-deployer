<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServerRoom */

$this->title = Yii::t('app', 'Create Server Room');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Server Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-room-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
