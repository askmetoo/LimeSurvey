<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

// DO NOT REMOVE This is for automated testing to validate we see that page
echo viewHelper::getViewTestTag('tutorialentries');

?>
<div class="container-fluid ls-space padding left-50 right-50">
    <div class="ls-flex-column ls-space padding left-35 right-35">
        <div class="col-12 h1 pagetitle">
            <?php eT('Tutorial entries')?> 
        </div>
        <div class="col-12">
            <a class="btn btn-primary pull-right col-6 col-md-3 col-lg-2" id="createnewtutorialentry" >
                <i class="fa fa-plus"></i>&nbsp;<?php eT('New') ?>
            </a>	
            <?php if(Permission::model()->hasGlobalPermission('superadmin','read')):?>
            <a class="btn btn-danger pull-right ls-space margin right-10 col-6 col-md-3 col-lg-2" href="#restoremodal" data-toggle="modal">
                <i class="fa fa-refresh"></i>&nbsp;
                <?php eT('Reset') ?>
            </a>
            <?php endif; ?>	
        </div>
		<div class="col-12 ls-space margin top-15">
			<div class="col-12 ls-flex-item">
				<?php $this->widget('yiistrap.widgets.TbGridView', array(
					'dataProvider' => $model->search(),
					// Number of row per page selection
					'id' => 'tutorial-grid',
					'columns' => $model->getColumns(),
					'filter' => $model,
					'emptyText'=>gT('No customizable entries found.'),
					'summaryText'=>gT('Displaying {start}-{end} of {count} result(s).').' '. sprintf(gT('%s rows per page'),
						CHtml::dropDownList(
							'pageSize',
							$pageSize,
							Yii::app()->params['pageSizeOptions'],
							array('class'=>'changePageSize form-control', 'style'=>'display: inline; width: auto')
						)
					),
					'rowHtmlOptionsExpression' => '["data-tutorialentry-id" => $data->teid]',
                    'htmlOptions'              => ['class' => 'table-responsive grid-view-ls'],
                    'ajaxType'                 => 'POST',
                    'ajaxUpdate'               => true,
                    'template'                 => "{items}\n<div id='tokenListPager'><div class=\"col-md-4\" id=\"massive-action-container\"></div><div class=\"col-md-4 pager-container ls-ba \">{pager}</div><div class=\"col-md-4 summary-container\">{summary}</div></div>",
                    'afterAjaxUpdate'          => 'bindAction',
				));
				?>
			</div>
		</div>
	</div>
</div>
