<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-6">
        <?php if(Helper::checkRoute('/deployment/deploy')){ foreach($model->commandActions as $key => $commandAction){ ?>
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::a(Yii::t('app', $commandAction->name), ['/deployment/deploy', 'id' => $model->id, 'action_id' => $commandAction->id], ['class' => 'btn btn-danger btn-flat', 'target' => '_brank']) ?>
</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                  </div>
                </div>
                <div class="box-body table-responsive">
					<table class="table table-striped table-bordered detail-view">
						<th>步骤</th><th>执行用户</th>
						<?php foreach($commandAction->commandScripts as $commandScript){
							echo '<tr><th>'.$commandScript->name.'</th><td>'.$commandScript->runner.'</td></tr>';
						}?>
                    </table>
                </div>
            </div>     
        <?php }} ?>
    </div>    
    <div class="col-sm-6">
        <div class="project-view box box-primary row">
            <div class="box-header">
                <?= Helper::checkRoute('update') ? Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) : '' ?>
                <?= Helper::checkRoute('delete') ? Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-flat',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) : '' ?>
                <?= Html::a(Yii::t('app', 'Return List'), ['index'], ['class' => 'btn btn-info btn-flat pull-right']) ?>
            </div>      
            <div class="box-body table-responsive">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'creater_id',
                        'project_group_id',
                        'name',
                        'depository.address',
                        'repo_address',
                        'repo_account',
                        'repo_password',
                        'repo_private_key',
                        'repo_branch',
                        'desc',
                        'status',
                        'type',
                        'published_at',
                        'created_at:datetime',
                        'updated_at:datetime',
                        'deleted_at',
                        'order',
                        'remark:ntext',
                    ],
                ]) ?>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>
