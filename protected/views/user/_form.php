<div class="form">

<? $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)) ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model) ?>

	<div class="row">
		<?= $form->labelEx($model,'username') ?>
		<?= $form->textField($model,'username',array('size'=>30,'maxlength'=>128)) ?>
		<?= $form->error($model,'username') ?>
	</div>

<? if ($model->isNewRecord) { ?>
	<div class="row">
		<?= $form->labelEx($model,'password') ?>
		<?= $form->passwordField($model,'password',array('size'=>30,'maxlength'=>60)) ?>
		<?= $form->error($model,'password') ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'password_repeat') ?>
		<?= $form->passwordField($model,'password_repeat',array('size'=>30,'maxlength'=>60)) ?>
		<?= $form->error($model,'password_repeat') ?>
	</div>
<? } else { ?>
    <div class="row">
        <a href="/user/changePassword">Change Password</a>
    </div>
<?}?>

   	<div class="row">
		<?= $form->labelEx($model,'email') ?>
		<?= $form->textField($model,'email',array('size'=>30,'maxlength'=>128)) ?>
		<?= $form->error($model,'email') ?>
	</div>


<? if ($model->isNewRecord) { ?>
	<div class="row">
		<?= $form->labelEx($model,'validacion') ?>
        <? $this->widget('application.extensions.recaptcha.EReCaptcha',
           array('model'=>$model, 'attribute'=>'validacion',
                 'theme'=>'clean', 'language'=>'zh_TW',
                 'publicKey'=>Yii::app()->params['recaptcha_publickey'])) ?>
        <?= $form->error($model,'validacion') ?>
	</div>
<? } ?>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save') ?>
	</div>

<? $this->endWidget() ?>

</div><!-- form -->

