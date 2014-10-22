<h2>Updating User:  <?= CHtml::encode($model->username) ?></h2>

<? if (Yii::app()->user->checkAccess('admin')) { ?>
<div class="actionBar">
[<?= CHtml::link('New User', array('create')) ?>]
[<?= CHtml::link('Manage Users', array('admin')) ?>]
</div>
<? } ?>

<?= $this->renderPartial('_form', array(
	'model'=>$model,
    'scenario'=>'update',
	'update'=>true
)) ?>
