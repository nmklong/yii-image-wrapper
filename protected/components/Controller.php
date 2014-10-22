<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    function init() {
        parent::init();

        /* Set the app language if the session's language is supported */
        $language = Utils::get(Yii::app()->session, 'language', Yii::app()->params['language']);
        if (Utils::isLanguageSupported($language))
            Yii::app()->language = $language;
    }

    public function renderEmail($template, $data=array()) {
        $path = Yii::getPathOfAlias('application.views.email').'/'.$template.'.php';
        if (!file_exists($path)) throw new Exception('Template '.$path.' does not exist');
        return $this->renderFile($path, $data, true);
    }
}
