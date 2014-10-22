<div class="actionBar">
<? if (Yii::app()->user->checkAccess('admin')) { ?>
[<?= CHtml::link('Manage Users', array('admin')); ?>]
<? } ?>
</div>

<?= $this->renderPartial('_form', array(
	'model'=>$model,
    'scenario'=>'create',
	'update'=>false,
)) ?>

