<?php

class NodeController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
        

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$model = $this->loadModel();
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            if(Yii::app()->request->isPostRequest)
            {
                // we only allow deletion via POST request
                $model = $this->loadModel($id);
                $model->deleteFormTable();
                $this->loadModel($id)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CckNode('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CckNode']))
			$model->attributes=$_GET['CckNode'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all models.
	 */
        public function actionCreate()
        {
            $formNode = new CckNode();
            $formNode->setScenario("create");
            if(isset($_POST['CckNode']))
            {
                $formNode->attributes = $_POST['CckNode'];
                if($formNode->validate())
                {
                    $formNode->save();
                    $formNode->createFormTable();
                    $this->redirect("/cck/nodeField/create/node_id/".$formNode->id);
                }
            }
            $this->render('create', array( "formNode" => $formNode));
        }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CckNode']))
		{
			$model->attributes=$_POST['CckNode'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	public function actionIndex()
	{
            $dataProvider = new CActiveDataProvider('CckNode');
            $this->render('index', array(
                'dataProvider'=>$dataProvider,
            ));
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
