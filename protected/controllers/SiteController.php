<?php

class SiteController extends Controller {
    /**
 	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
			# captcha action renders the CAPTCHA image displayed on the contact page
			#'captcha'=>array(
			#	'class'=>'CCaptchaAction',
			#	'backColor'=>0xFFFFFF,
			#),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
	    #if (Yii::app()->user->isGuest) {
        #    $this->render('index');
        #} else {
        #    if (Yii::app()->user->checkAccess('admin')) {
        #        $this->redirect(array('admin/index'));
        #    } else {
        #        $this->redirect(array('user/accountBalance', 'id'=>Yii::app()->user->_id));
        #    }
	    #}
        $this->render('index');
	}
    public function actionChangeLanguage() {
        /* Change the session's language if the requested language is
         * supported */
        Utils::changeLanguage(Utils::get($_GET, 'lang'));

        /* Return to the previous page */
        $returnUrl = Yii::app()->request->urlReferrer;
        if (!$returnUrl)
            $returnUrl = '/';
        $this->redirect($returnUrl);
    }


	private function loadUser() {
	  return User::model()->findbyPk(Yii::app()->user->_id);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
	    if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
	    		echo $error['message'];
            }
	    	else {
	        	$this->render('error', $error);
            }
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact() {
		$model = new ContactForm;
		if (isset($_POST['ContactForm'])) {
			$model->attributes=$_POST['ContactForm'];
			if ($model->validate()) {
				$headers = "From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact',
                    'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	public function actionSupport() {
		$this->render('support');
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$model = new LoginForm;
		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionSu() {
        $form = new SuLoginForm;
        if (isset($_POST['SuLoginForm'])) {
            $form->attributes = $_POST['SuLoginForm'];
            // validate user input and redirect to previous page if valid
            if ($form->validate()) {
                ## log su
                #$u= new ActiveRecordLog;
                #$u->description=  'User ' . Yii::app()->user->Name . ' LOGIN ';
                #$u->action=       'LOGIN';
                #$u->creationdate= date('Y-m-d H:i:s');
                #$u->userid=       Yii::app()->user->id;
                #$u->save();
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        $this->render('su', array('form'=>$form)) ;
    }

}
