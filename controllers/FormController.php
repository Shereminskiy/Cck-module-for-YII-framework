<?php

class FormController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
        

	/**
	 * @return array action filters
	 */
//	public function filters()
//	{
//		return CMap::mergeArray(parent::filters(),array(
//			'accessControl', // perform access control for CRUD operations
//		));
//	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
//	public function accessRules()
//	{
//		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
//		);
//	}





	public function actionIndex()
	{
            $request = Yii::app()->request;
            $module=Yii::app()->controller->module;
            $from_key = $request->getParam("form_id");
            if($from_key) {
                $prefix = CckNode::model()->getFormPrefix();
                $machine_name = $className = CckNode::model()->getFormPrefix().StringFunctions::seo_url(trim(strtolower($from_key)), "_");
                $className = StringFunctions::generateClassName($className);

                if(class_exists($className)) {
                    $parentNode = CckNode::model()->find("machine_name = :mid", array(":mid" => $machine_name));
                    if($parentNode) {
                        $model = new $className();
                        $model->node_id = $parentNode->id;
                        $fields = CckNodeField::model()->getArrayOfFileds($parentNode->id);
                        $post = $request->getPost($className);
                        if($post) {
                           $model->attributes = $post;
                           if($model->validate()) {
                               // does through all field and check is_array then call serialise and seve parameters as string
                               foreach($model->attributes as $key => $attr) {
                                   if(is_array($attr)) { // if attribute has value as array then do serializing of the value
                                       $model->$key = serialize($attr);
                                   }
                               }
                               $model->save();
                               $this->redirect ($module->successUrlSubmitForm);
                           }
                        }
                        $this->render('index', array("model" => $model, "fielsInfos" => $fields));
                        return true;
                    }
                }
            }
            $this->redirect($module->errorParamsUrl);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
            if($this->_model===null)
            {
                if(isset($_GET['id']))
                    $this->_model=CckNode::model()->findbyPk($_GET['id']);
                if($this->_model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            }
            return $this->_model;
	}

}
