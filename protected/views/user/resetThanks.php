<?php $this->pageTitle=Yii::app()->name . ' - Password Reset' ?>

<h1>Password Reset</h1>

<p>For security reasons, we cannot tell you if the email you entered is valid or not.<br/>
If it is valid, we will send new password.</p>

<p><?= CHtml::link("Contact us", "mailto:" .
Yii::app()->params['support_email']) ?> if you are having problems and we will
get it sorted out.</p>

