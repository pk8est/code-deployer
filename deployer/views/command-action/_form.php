<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\ActiveForm;
use mdm\admin\components\Helper;
use deployer\assets\AdminLtePluginAsset;
use common\models\CommandScript;

/* @var $this yii\web\View */
/* @var $model common\models\CommandAction */
/* @var $form yii\widgets\ActiveForm */
AdminLtePluginAsset::addJsFile($this, AdminLtePluginAsset::getBaseUrl() . '/plugins/jQueryUI/jquery-ui.min.js');
AdminLtePluginAsset::addJsFile($this, AdminLtePluginAsset::getDistUrl() . '/js/pages/dashboard.js');

$commandActionScripts = $model->commandActionScripts;
$commandScripts = CommandScript::findAll(['status' => CommandScript::STATUS_NORMAL]);
$this->registerJsVar('commandScriptRenderCount', 0);
$this->registerJs('var commandActionScripts = '. Json::encode($commandActionScripts), View::POS_HEAD);
$this->registerJs('var commandScripts = '. Json::encode(array_index($commandScripts, 'id')), View::POS_HEAD);
$this->registerJs('
	for(index in commandActionScripts){
		renderCommandScript(commandScripts[commandActionScripts[index].script_id], index)
	}
');
$this->registerJs('
function renderCommandScript(item, index){
	var id = "command-script-item-" + item.id
	var html = `<li id="${id}">
		<input type="hidden" name="commandScripts[${commandScriptRenderCount}][id]" value="${item.id}" />
		<!-- drag handle -->
		<span class="handle">
			<i class="fa fa-ellipsis-v"></i>
			<i class="fa fa-ellipsis-v"></i>
		</span>
		<!-- checkbox -->
		<input type="checkbox" value="">
		<!-- todo text -->
		<span class="text">${item.name}</span>
		<!-- Emphasis label -->
		<small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
		<!-- General tools such as edit or delete-->
		<div class="tools">
			<i class="fa fa-trash-o" onClick="removeCommandScript(\'${id}\')"></i>
		</div>
	</li>`
	$("#command-script-list").append(html)
	commandScriptRenderCount++;
}

function addCommandScript(){
	var id = $("#command_script_select").val();
	if(!id) return
	renderCommandScript(commandScripts[id])
	$("#command-script-dropdownlist").modal("hide")
}

function removeCommandScript(id){
	$("#" + id).remove()
}
', View::POS_END)
?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-sm-6">
		<div class="command-action-form box box-primary">
			<div class="box-body table-responsive">
				<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'status')->dropDownList(array_list($model->statusArr, 'name')) ?>

				<?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

			</div>
			<div class="box-footer">
				<?= Helper::checkRoute('view') && $model->getPrimaryKey() ? Html::a(Yii::t('app', 'View'), ['view',  'id' => $model->id], ['class' => 'btn btn-success btn-
		flat']) : '' ?>
				<?= Helper::checkRoute('index') ? Html::a(Yii::t('app', 'Return List'), ['index'], ['class' => 'btn btn-info btn-flat']) : '' ?>
				<?= Helper::checkRoute('update') ? Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-danger btn-flat']) : '' ?>
			</div>
		</div>
	</div>
    <div class="col-sm-6">
		<!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
        
              <h3 class="box-title">Script List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list" id="command-script-list">
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" data-toggle="modal" data-target="#command-script-dropdownlist" title="<?= Yii::t('app', 'Add Command Script') ?>"  class="btn btn-info pull-right"><i class="fa fa-plus"></i> <?= Yii::t('app', 'Add Command Script') ?></button>
            </div>
          </div>

        </div>
	</div>
</div>

<?php ActiveForm::end(); ?>

<div class="modal fade" id="command-script-dropdownlist">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-comment-o"></i> <?= Yii::t('app', 'Add Command Script') ?></h4>
            </div>
     
            <div class="modal-body">
				<?= Html::dropDownList('command_script_select', '', arr_map($commandScripts, 'id', 'name'), [
					'class' => 'form-control', 
					'id' => 'command_script_select',
					'prompt' => '--',
				]) ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger pull-right btn-save" onClick="addCommandScript()"> <i class="fa fa-save"></i> 添加</button>
            </div>
        </div>
    </div>
</div>

