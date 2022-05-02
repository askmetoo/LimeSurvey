<?php echo CHtml::beginForm($action, 'post', array('class'=>'form-horizontal container-fluid')) ?>
<div class="row">
    <label class='col-md-2 offset-lg-2 text-end form-label' for='uid'>
        <?php eT("User"); ?>
    </label>
    <div class='col-md-4 '>
        <?php echo CHtml::dropDownList(
            'uid',
            '',
            CHtml::listData($oAddUserList,'uid','users_name'),
            array(
                'empty' => gT("Please choose..."),
                'class'=> 'form-control',
                'required' => true,
            )
        ); ?>
    </div>
    <div class='col-md-4 '>
        <?php echo CHtml::button(gT("Add user"),array('class'=>'btn btn-default', 'type'=>'submit')); ?>
    </div>
</div>
</form>
