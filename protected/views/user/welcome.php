<? $this->pageTitle = Yii::app()->name . ' - Welcome' ?>

<h1>Welcome!</h1>

<p style="width: 35em">We have created your account and sent you an email to make sure that your
email address works. Please click on the link in the email to activate your account. 
If you don't receive the email within a few minutes, please check your spam filters, 
or <?= CHtml::link("resend the email", array("user/sendActivationEmail", 'id'=>$user->id)) ?>.</p>

<p><?= CHtml::link("Log in", array('site/login')) ?> to configure your account.</p>

<p><?= CHtml::link("Contact us", "mailto:" . 
Yii::app()->params['support_email']) ?> if you are having problems and we will 
get it sorted out.</p>

