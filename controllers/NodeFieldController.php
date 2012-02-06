<?php

class NodeFieldController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
                
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            $model=new CckNodeField;
            $model->setScenario("create");
            if (isset($_GET["node_id"], $_GET["type"])) {
                $nodeModel = CckNode::model()->findByPk((int)$_GET["node_id"]); // get pagent model
                if($nodeModel && in_array($_GET["type"], FieldsCck::getFormItem())) { //pagent node with sets "node_id" is exist and type of item is exist
                    $model->node_id = (int)$_GET["node_id"];
                    $model->type = $_GET["type"];
                    // appay additional extra parametres fro each field from defined field Class
                    $model->appayExtraParams(); // extract all 'extra' field values

                    if (isset($_POST['CckNodeField'])) {
//                        $model->attributes = $_POST['CckNodeField'];
                        $model->applyAttributesToField($_POST['CckNodeField']); // safe all form values in object fileds
                        $transaction=$model->dbConnection->beginTransaction();
                        try {
                            $model->extra = serialize($model->extra);
                            if($model->save()) {
                                $node_has = new CckNodeHasField();
                                $node_has->node_id = $model->node_id;
                                $node_has->field_id = $model->id;

                                if($node_has->validate()) {
                                    $node_has->save();
                                    $model->addFieldToTable(); // call alter table for the node form in accordance with new column
                                    $model->genetateModelFile();
                                    $transaction->commit();
                                    $this->redirect(array('admin','node_id'=>$model->node_id));
                                    return true;
                                } else {
                                    $model->extra = unserialize($model->extra);
                                    $transaction->rollBack();
                                }
                            } else {
                                $model->extra = unserialize($model->extra);
                                $transaction->rollBack();
                            }
                        }catch(Exception $e){
                            $model->extra = unserialize($model->extra);
                            $transaction->rollBack();
                        }
                    }
                    $this->render('create', array( "model" => $model, "node_id" => $model->node_id));
                    return true;
                }
            }
            $this->redirect("/cck/node");
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                // appay additional extra parametres for each field from defined field Class
                $model->appayExtraParams();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                if(isset($_POST['CckNodeField'])) {
                    if($model && in_array($_POST['CckNodeField']["type"], FieldsCck::getFormItem())) { //pagent node with sets "node_id" is exist and type of item is exist
                        $model->applyAttributesToField($_POST['CckNodeField']);

                        $transaction=$model->dbConnection->beginTransaction();
                        try {
                            $model->extra = serialize($model->extra);
                            if($model->save()) {
                                $model->node_id = $model->cckNodeHasFields[0]->node->id;
                                $model->addFieldToTable(true);
                                $model->genetateModelFile();
                                $transaction->commit();
                                $this->redirect(array('admin','node_id'=>$model->node_id));
                                return true;
                            } else {
                                $model->extra = unserialize($model->extra);
                                $transaction->rollBack();
                            }
                        }catch(Exception $e){
                            $transaction->rollBack();
                        }
                    }
		}

		$this->render('update',array(
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
                    $model->removeFieldTable();
                    $model->genetateModelFile();
                    $model->delete();
                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            if (isset($_GET["node_id"])) {

                $criteria=new CDbCriteria;
                $criteria->together = TRUE;
                $criteria->with = array(
                        "cckNodeHasFields" => array(
                            'joinType'=>'INNER JOIN',
                            "condition" => "cckNodeHasFields.node_id =".(int)$_GET["node_id"],
                        )
                    );

//		$criteria->compare('node_id', (int)$_GET["node_id"]);
		$dataProvider=new CActiveDataProvider('CckNodeField', array('criteria'=> $criteria));
//                echo "<pre>";
//                var_dump($dataProvider->getItemCount());
//                echo "</pre>";

                $this->render('index',array('dataProvider'=>$dataProvider, "node_id" => (int)$_GET["node_id"]));
                return true;
            }
            $this->redirect("/cck/node/admin");
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            if (isset($_GET["node_id"])) {
		$model=new CckNodeField('search');
		$model->unsetAttributes();  // clear any default values
                $model->node_id = (int)$_GET["node_id"];
		if(isset($_GET['CckNodeField']))
			$model->attributes=$_GET['CckNodeField'];

		$this->render('admin',array(
			'model' => $model,
                        "node_id" => $model->node_id,
		));
                return true;
            }
            $this->redirect("/cck/node/admin");
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=CckNodeField::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cck-node-field-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
