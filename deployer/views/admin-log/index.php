<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax; 
use mdm\admin\components\Helper;
use deployer\events\Events;

/* @var $this yii\web\View */
/* @var $searchModel deployer\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Admin Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
				'uid',
                'level',
				[
					'attribute' => 'type',
					'format' => 'html',
					'filter' => array_list(Events::getAll(), 'desc'),
					'value' => function($model){
						$item = Events::get($model->type); 
						return '<span class="label label-'.e($item['code']).'">'.e($item['desc']).'</span>';
					}
				],
				'title',
                'category',
                'server_ip',
                'client_ip',
                'log_time:date',
                'prefix:ntext',
                // 'message:ntext',

				[
                    'class' => 'yii\grid\ActionColumn',
					'template' => '<div class="btn-group">'.Helper::filterActionColumn(['view']).'</div>',
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
