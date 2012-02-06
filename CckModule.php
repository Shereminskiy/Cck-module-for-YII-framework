<?php
/**
 * Yii-Cck module
 * 
 * @author Alexander Shereminskiy <aalex.prog@gmail.com>
 * @link http://yii-cck.googlecode.com/
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @version $Id: CckModule.php 105 2011-02-16 13:05:56Z mishamx $
 */
//Yii::import('system.gii.CCodeModel');
Yii::import('system.gii.CCodeFile');
class CckModule extends CWebModule
{


	public $tableNode = '{{cck_node}}';
	public $tableNodeField = '{{cck_node_field}}';
//	public $tableProfileFields = '{{profiles_fields}}';
	public $fieldListUrl = "/cck/nodeField/admin";

        public $pathToModels = "application.models";
        public $fieldClassSufix = "FieldCck";

        // parametres for FormControllek for cck module
        public $successUrlSubmitForm = "/cck/nodeField";
        public $errorParamsUrl = "/";

        public $fillFormUrl = "/cck/form/index/";

        public $protectedFileds = array("id", "node_id");

        

	/**
	 * @var array
	 * @desc Behaviors for models
	 */
	public $componentBehaviors=array();

	/**
	 * @var integer the permission to be set for newly generated code files.
	 * This value will be used by PHP chmod function.
	 * Defaults to 0666, meaning the file is read-writable by all users.
	 */
	public $newFileMode=0666;

	/**
	 * @var integer the permission to be set for newly generated directories.
	 * This value will be used by PHP chmod function.
	 * Defaults to 0777, meaning the directory can be read, written and executed by all users.
	 */
	public $newDirMode=0777;
        
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
                //$cs = Yii::app()->getClientScript();
                
                //$cs->registerCoreScript("jquery");
		// import the module-level models and components
		$this->setImport(array(
			'cck.models.*',
			'cck.components.*',
                        'cck.components.Fields.*',
                        'cck.components.Validators.*',
		));
	}

//        public $urlRules = array(
////            'forms/<form_id:\w+>' => 'cck/form',
//
//        );

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	/**
	 * @param $str
	 * @param $params
	 * @param $dic
	 * @return string
	 */
	public static function t($str='',$params=array(),$dic='cck') {
		return Yii::t("CckModule.".$dic, $str, $params);
	}
}
