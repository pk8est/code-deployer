<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel deployer\models\ServerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Servers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create Server'), ['create'], ['class' => 'btn btn-info btn-flat pull-right']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'room_id',
                'creater_id',
                'name',
                'desc',
                // 'ip',
                // 'inner_ip',
                // 'ssh_private_key',
                // 'status',
                // 'type',
                // 'level',
                // 'created_at',
                // 'updated_at',
                // 'deleted_at',
                // 'order',
                // 'remark:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
