<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<? $form = $this->beginWidget('CActiveForm') ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model) ?>

	<div class="row">
		<?= $form->labelEx($model,'username') ?>
		<?= $form->textField($model,'username') ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'password') ?>
		<?= $form->passwordField($model,'password') ?>
	</div>

	<div class="row rememberMe">
		<?= $form->checkBox($model,'rememberMe') ?>
		<?= $form->label($model,'rememberMe') ?>
	</div>

	<div class="row">
    <p class="hint"><?= CHtml::link("Lost Password", array('user/reset')) ?></p>
	</div>

	<div class="row submit">
		<?= CHtml::submitButton('Login') ?>
	</div>

<? $this->endWidget() ?>
</div><!-- form -->
