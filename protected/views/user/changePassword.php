<h2>Change Password</h2>

<? if (Yii::app()->user->hasFlash('password')) {
    echo $this->renderPartial('//shared/_flash' , array('name' => 'password')) ;
}?>

<div class="yiiForm">

<? $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>false,
)) ?>

<?= $form->errorSummary($user) ?>

    <div class="simple">
    <?= CHtml::activeLabelEx($user, 'Old Password'); ?>
    <?= CHtml::passwordField('User[password_old]'); ?>
    </div>

    <div class="simple">
    <?= $form->labelEx($user, 'New Password'); ?>
    <?= $form->passwordField($user, 'password_new'); ?>
    </div>

    <div class="simple">
    <?= $form->labelEx($user,'Confirm New Password'); ?>
    <?= $form->passwordField($user,'password_repeat'); ?>
    </div>

    <div class="action">
      <?= CHtml::submitButton('Save'); ?>
    </div>
    <? $this->endWidget() ?>

</form>
</div><!-- yiiForm -->
