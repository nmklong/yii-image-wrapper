<?
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<h1>Contact Us</h1>

<? if (Yii::app()->user->hasFlash('contact')) {
    $this->renderPartial('//shared/_flash' , array('name' => 'contact')) ;
 } else { ?>

<p>If you have any questions, please fill out the following form to contact us.</p>

<div class="form">

<? $form=$this->beginWidget('CActiveForm'); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<?= $form->labelEx($model,'name'); ?>
		<?= $form->textField($model,'name'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'email'); ?>
		<?= $form->textField($model,'email'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'subject'); ?>
		<?= $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'body'); ?>
		<?= $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
        <?= $form->labelEx($model, 'validacion') ?>
        <? $this->widget('application.extensions.recaptcha.EReCaptcha',
            array('model'=>$model, 'attribute'=>'validacion',
                  'theme'=>'clean', 'language'=>'zh_TW',
                  'publicKey'=>Yii::app()->params['recaptcha_publickey'])) ?>
	</div>

	<div class="row submit">
		<?= CHtml::submitButton('Submit'); ?>
	</div>

<? $this->endWidget(); ?>

</div><!-- form -->

<? } ?>
