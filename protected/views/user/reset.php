<?php $this->pageTitle=Yii::app()->name . ' - Reset Password' ?>

<style type="text/css">
.sb-content{
    margin: 20px 0 0 0;
    padding: 0 0 0 125px;
    background-image:url(/images/manman.gif);
    background-repeat: no-repeat;
    background-position: 30px 0px;
    min-height: 100px;
}

.sb-content h1 {
    font-family:Arial, Helvetica, sans-serif;
    color: #1B75BC;
    font-size: 26px;
    line-height: 36px;
}

.sb-content p {
    font-family:Arial, Helvetica, sans-serif;
    color: #000000;
    font-size: 14px;
    line-height: 18px;
}
</style>

<div class="sb-content">
  <h1>Reset Password</h1>
  <p class="intro">If you have lost your password, enter your email and we will send you the new password.</p>
  </p>
    <p>
        <?= CHtml::form() ?>
        <input name="reset_user" id="reset_user" type="text" value="" />&nbsp;<?= CHtml::submitButton('Reset') ?>
    </p>
</div><!--sb-content-->

<table><tr><td height=200px>&nbsp;</td></tr></table>
