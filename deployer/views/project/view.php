<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use mdm\admin\components\Helper;
use common\models\CommandAction;
use common\models\ServerGroup;
use common\models\ProjectAction;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$projectActionModel = new ProjectAction();
$projectActionModel->project_id = $model->id;

$this->registerCss('

');
$this->registerJs('

');

?>
<div class="row">
    <div class="col-sm-6">
        <?php if(Helper::checkRoute('/deployment/deploy')){ foreach($model->projectActions as $key => $projectAction){ ?>
			<?php 
				$commandAction = $projectAction->getCommandAction()->one(); 
				$id = $projectAction->id;
			?>
            <div class="box box-danger">
                <div class="box-header with-border">
                    <div class="btn-group">
                      <button type="button" class="btn btn-default btn-flat" data-toggle="tab" href="#deploy-<?= $id ?>">发布</button>
                      <button type="button" class="btn btn-default btn-flat" data-toggle="tab" href="#step-<?= $id ?>">步骤</button>
                      <button type="button" class="btn btn-default btn-flat" data-toggle="tab" href="#other-<?= $id ?>">信息</button>
                    </div>
                    <!--<h3 class="box-title"><?= Html::a(Yii::t('app', $commandAction->name), ['/deployment/deploy', 'id' => $model->id, 'action_id' => $commandAction->id], ['class' => 'btn btn-danger btn-flat', 'target' => '_brank']) ?></h3>-->
					<div class="box-tools pull-right">
						<?= Helper::checkRoute('/project-action/delete') ? Html::a('<i class="fa fa-close"></i>', [
							'/project-action/delete', 
							'id' => $projectAction->id,
							'returnUrl' => Yii::$app->request->getUrl(),
						], [
               			    'class' => 'btn btn-box-tool',
           			        'data' => [
                      		'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                       		'method' => 'post',
                   		  ],
             		    ]) : '' ?>						
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                  </div>
                </div>
                <div class="box-body table-responsive">	
					<div class="tab-content">
                        <div class="tab-pane active" id="deploy-<?= $id ?>">
							<?php foreach($projectAction->serverGroups as $key => $serverGroup) { ?>
          						<div class="box box-solid">
            						<div class="">
              							<span class="box-title"><?= $serverGroup->name ?></span>
										<?php foreach($serverGroup->servers as $server) { ?>
											<span class="label label-default"><?= $server->ip ?></span>
										<?php } ?>
            						</div>
          						</div>
							<?php } ?>

                    		<?= Html::a(Yii::t('app', $commandAction->name), ['/deployment/deploy', 'id' => $model->id, 'action_id' => $commandAction->id], ['class' => 'btn btn-danger btn-flat btn-block', 'target' => '_brank']) ?>
                        </div>
                        <div class="tab-pane" id="step-<?= $id ?>">
							<table class="table table-striped table-bordered detail-view">
								<th>步骤</th><th>执行用户</th>
								<?php foreach($commandAction->commandScripts as $item){
									echo '<tr><th>'.$item->commandScript->name.'</th><td>'.$item->commandScript->runner.'</td></tr>';
								}?>
							</table>
                        </div>
                    	<div class="tab-pane" id="other<?= $id ?>">Other</div>
                    </div>
                </div>
            </div>     
        <?php }} ?>
		<div class="box-footer clearfix no-border">
              <button type="button" data-toggle="modal" data-target="#command-action-dropdownlist" title="<?= Yii::t('app', 'Add Command Action') ?>"  class="btn btn-info pull-right"><i class="fa fa-plus"></i> <?= Yii::t('app', 'Add Command Action') ?></button>
       </div>
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


<div class="modal fade" id="command-action-dropdownlist">
    <div class="modal-dialog">
        <div class="modal-content">
			<?php $form = ActiveForm::begin(['action' => to_route(['project-action/create', 'goto' => Yii::$app->request->url])]); ?>	
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-comment-o"></i> <?= Yii::t('app', 'Add Command Action') ?></h4>
            </div>

            <div class="modal-body">
				
				<?= $form->field($projectActionModel, 'project_id', ['template' => '{input}'])->hiddenInput() ?>
				
				<?= $form->field($projectActionModel, 'action_id')->widget(Select2::classname(), [
               		'data' => arr_map(CommandAction::findAll(['status' => CommandAction::STATUS_NORMAL]), 'id', 'name'),
               		'options' => ['placeholder' => 'Select a action ...'],
            	    'pluginOptions' => [
        	            'allowClear' => true
    	            ],
	            ]) ?>

				<?= $form->field($projectActionModel, 'server_group_ids')->widget(Select2::classname(), [
                    'data' => arr_map(ServerGroup::findAll(['status' => ServerGroup::STATUS_NORMAL]), 'id', 'name'),
                    'options' => ['placeholder' => 'Select a server group ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
						'multiple' => true,
                    ],
                ]) ?>
			
			</div>
            <div class="modal-footer">
				<?= Html::submitButton(Yii::t('app', 'Add'), ['class' =>'btn btn-success']) ?>
            </div>
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
