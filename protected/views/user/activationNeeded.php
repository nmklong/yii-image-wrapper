<?php $this->pageTitle = Yii::app()->name . ' - Welcome' ?>

<h1>Account Activation</h1>

<div class="yiiForm">
<p>An account activation email has been emailed to your email address.</p>
<p>If you don't receive the email within a few minutes, please check your spam filters. <br/>
Click <?= CHtml::link("here", array("user/sendActivationEmail", 'id'=>$user->id)) ?> to resend the email
or <?= CHtml::link("contact us", "mailto:" . Yii::app()->params['support_email']) ?>&nbsp; 
and we will get it sorted.
</p>
</div><!-- yiiForm -->
