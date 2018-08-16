<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\Depository */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Depositories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="depository-view box box-primary">
    <div class="box-header">
        <?= Helper::checkRoute('update') ? Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) : '' ?>
        <?= Helper::checkRoute('delete') ? Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) : '' ?>
		<?= Helper::checkRoute('index') ? Html::a(Yii::t('app', 'Return List'), ['index'], ['class' => 'btn btn-info btn-flat pull-right']) : '' ?>
    </div>
    <div class="box-body table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'type',
                'address',
                'account',
                'password',
                'private_key',
                'public_key',
                'status',
                'created_at:datetime',
                'updated_at:datetime',
                'deleted_at',
                'order',
                'remark:ntext',
            ],
        ]) ?>
    </div>
</div>
