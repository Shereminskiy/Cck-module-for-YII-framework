<?php

/**
 * This is the model class for table "{{cck_node_field}}".
 *
 * The followings are the available columns in table '{{cck_node_field}}':
 * @property integer $id
 * @property integer $node_id
 * @property string $type
 * @property integer $status
 * @property string $field_label
 * @property string $field_name
 * @property string $extra
 * @property string $default_values
 * @property integer $requred
 * @property string $values
 * @property integer $weight
 * @property integer $is_php_value
 * @property integer $is_php_def_value
 *
 * The followings are the available model relations:
 * @property CckNode $node
 */
class CckNodeField extends CActiveRecord
{
        public $node_id = NULL;
        public $htmlOptions;

        
        /*
         * This is additional values which can be used in attributes for diferent types of fields.
         * For example 'махlength' and 'minlength' and 'unique' are useing in TextFieldCck method 'getExtraOptions'.
         */
        public $maxlength = 10;
        public $minlength = 1;
        public $unique = 1;
//        public $messageUnique;
        public $modelAttributes = array();

        public function  __get($name) {
            try {
                return parent::__get($name);
            } catch (Exception $e) {
                if (isset($this->modelAttributes[$name])) {
                    return $this->modelAttributes[$name];
                } else {
                    return $this->modelAttributes[$name] = "";
                }
            }
        }

	/**
	 * PHP setter magic method.
	 * This method is overridden so that AR attributes can be accessed like properties.
	 * @param string $name property name
	 * @param mixed $value property value
	 */
	public function __set($name,$value)
	{
            try {
                parent::__set($name,$value);
            } catch (Exception $e) {
                return $this->modelAttributes[$name] = $value;
            }
	}


	/**
	 * Checks if a property value is null.
	 * This method overrides the parent implementation by checking
	 * if the named attribute is null or not.
	 * @param string $name the property name or the event name
	 * @return boolean whether the property value is null
	 */
	public function __isset($name)
	{
		if (isset($this->_attributes[$name]))
                    return true;
                else if (isset($this->modelAttributes[$name]))
                    return $this->modelAttributes[$name];
		else if(isset($this->getMetaData()->columns[$name]))
                    return false;
		else if(isset($this->_related[$name]))
                    return true;
		else if(isset($this->getMetaData()->relations[$name]))
                    return $this->getRelated($name)!==null;
		else
                    return parent::__isset($name);
	}


	/**
	 * Sets a component property to be null.
	 * This method overrides the parent implementation by clearing
	 * the specified attribute value.
	 * @param string $name the property name or the event name
	 */
	public function __unset($name)
	{
                if (isset($this->modelAttributes[$name]))
                    unset ($this->modelAttributes[$name]);
		else if (isset($this->getMetaData()->columns[$name]))
                    unset ($this->_attributes[$name]);
		else if(isset($this->getMetaData()->relations[$name]))
                    unset ($this->_related[$name]);
		else
                    parent::__unset($name);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * @return CckNodeField the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{cck_node_field}}';
	}

        public function   afterFind() {
            parent::afterFind();

            if(is_string($this->extra) && $this->extra != "Array") {
                // unserialize all extra fields and apply all aditional fileds in the model which were not sevedin model fieldse
                $this->extra = unserialize($this->extra);
                $this->node_id = $this->cckNodeHasFields[0]->node->id;
                $this->appayExtraParams();

                
            }
        }

        /*
         * Goes through all declared attributes of current field type and redeclare all default values.
         */
        public function applyAttributesToField($post)
        {
            if(isset($post["values"]))
                $this->values = $post["values"];

            if(isset($post["default_values"]))
                $this->default_values = $post["default_values"];

            $this->attributes = $post;
            // go through all declared attributes of current field type and redeclare all default values.
            if(isset ($this->extra["attributes"]) && is_array($this->extra["attributes"])) {
                $attribut = $this->extra["attributes"];
                foreach ($this->extra["attributes"] as $key => $attributes) {
                    if(isset($attributes["widgetParams"]["fields"]) && is_array($attributes["widgetParams"]["fields"])) {
                        foreach ($attributes["widgetParams"]["fields"] as $k => $val) {
                            if(isset($post[$k]))
                                $this->$k = $attribut[$key]["widgetParams"]["fields"][$k]["value"] = $post[$k];
                        }
                    }
                }

                $this->extra = array_merge($this->extra, array("attributes" => $attribut));
            }
        }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		$rules =  array(
			array('type, field_label, field_name, values', 'required'),
			array('status, requred, weight, is_php_value, is_php_def_value', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>30),
                        array('field_name', 'unique', 'on'=>"create"),
			array('field_label', 'length', 'max'=>255),
			array('field_name', 'length', 'max'=>100),
			array('id, type, status, field_label, field_name, extra, default_values, requred, values, weight, is_php_value, is_php_def_value', 'safe', 'on'=>'search'),
		);

                if(isset($this->extra["value_requred"]) && $this->extra["value_requred"] == false) {
                    foreach($rules as $k => $value) {
                        if($value[1] == "required") { // search requred field
                            $rules[$k][0] = str_replace(", values", '', $value[0]); // do find and replase from ", values" to ''
                        }
                    }
                }

                // go through all declared "validate" attributes of current field type and redeclare all defined validators.
                if(isset ($this->extra["attributes"]) && is_array($this->extra["attributes"])) {
                    foreach ($this->extra["attributes"] as $key => $attributes) {
                        if(isset ($this->$key, $attributes["validate"]) && is_array($attributes["validate"]) ) { // Check. Does field declared and class "FieldsCck" has devault value in class "CckNodeField".
                            $rules = array_merge($rules, $attributes["validate"]);
                        }
                    }
                }
                return $rules;
	}

        public function beforeValidate()
        {
            $this->default_values = trim($this->default_values);
            $this->field_name = strtolower(StringFunctions::seo_url($this->field_name, '_'));
            return parent::beforeValidate();
        }


        /*
         * Display url to the form for filling by 'machine_name'
         *
         */
        public static function getFullFormUrl($title = "", $machine_name = NULL )
        {
            $module = Yii::app()->controller->module;
            $cn = new CckNode();
            $key = str_replace($cn->getFormPrefix(), '', $machine_name);
            echo CHtml::link($title, array($module->fillFormUrl, "form_id" => $key));
        }

        public static function getListUrl($title = "", $nid = NULL)
        {
            $module=Yii::app()->controller->module;
            echo CHtml::link($title, array($module->fieldListUrl, "node_id" => $nid));
        }
        
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                        'cckNodeHasFields' => array(self::HAS_MANY, 'CckNodeHasField', 'field_id'),
		);
	}
        public function removeFieldTable()
        {
            if($this->cckNodeHasFields[0]->node->machine_name) {
                $this->node_id = $this->cckNodeHasFields[0]->node->id;
                $command = Yii::app()->db->createCommand();
                try {
                    $command->dropColumn($this->cckNodeHasFields[0]->node->machine_name, $this->field_name);
                    $command->reset();
                } catch (Exception $e) {
                    Yii::log("Catch Exaption in commant 'command->dropColumn(".$this->field_name.")'.  ".$e->getMessage(), 'error');
                }
            }
        }

        public function getArrayOfFileds($node_id = NULL)
        {
            $fields = array();
            $fieldModels = $this->with(
                array("cckNodeHasFields" =>array(
                        "condition" => "node_id = ".$node_id,
                        "together" => true,
                    )
                )
            )->findAll(array(
                 'order'=>'t.weight ASC',
                 'condition'=>'t.status=1',
            ));

            foreach ($fieldModels as $fieldModel) {
                //need to prepare parametres of rendering of element
                // forst of all need to 'prepare' value and 'default_value' fields
                $fieldModel->values = $this->prepareValueField($fieldModel->attributes);
                $fieldModel->default_values = $this->prepareDefaultValueField($fieldModel->attributes);
                $fieldModel->extra = array("htmlOptions" => array());

                $fields[$fieldModel->field_name] = $fieldModel->attributes;
            }
            return $fields;

        }

        public function prepareDefaultValueField($field)
        {
            $val = "";
            if(isset($field["default_values"])) {
                $val = $field["default_values"];
                if($field["is_php_def_value"]){
                    $val = $this->evaluateExpression($field["default_values"]);
                }
            }
            return $val;
        }

        /*
         * Return prepared array of the 'value' field.
         *  If this field contains php exprasion calls eval function else does parce of the value;
         */
        public function prepareValueField($field)
        {
            $val = "";
            if(isset($field["values"])) {
                if($field["is_php_value"]){
                    $val = $this->evaluateExpression($field["values"]);
                } else {
                    $val = FieldsCck::parceValue($field["values"]);
                }
            }
            return $val;
        }


        /**
         * This method adds aditional extra paramentes in "this->extra" field, acodrind to geted type from field "this->type".
         * This method can receive type of filed  as a parametr "$typeField" if this field is empty receive value from $this->type.
         */
        public function appayExtraParams($typeField = NULL)
        {
            $extra = "";

            $type = ($typeField)? $typeField: $this->type;

            if($type && in_array($type, FieldsCck::getFormItem())) { // check. Type a precend and is exist in system
                $classFBame = ucfirst($type).Yii::app()->controller->module->fieldClassSufix;
                $class = new $classFBame($this);
                $extra = $class->getExtraOptions();

                if(is_array($this->extra)) {
                    // need to reset "value" field and update $extra field acording to  "getExtraOptions" values
                    // check is attributes exist and reset "values" in all attributes and "html_options"
                    if(isset($extra["attributes"]) && is_array($extra["attributes"])) {
                        foreach($extra["attributes"] as $key => $attr) {
                            if(isset($this->extra["attributes"][$key], $this->extra["attributes"][$key]["widgetParams"]["fields"]) && is_array($this->extra["attributes"][$key]["widgetParams"]["fields"])) { // cheking . the attribut is exist in $model object.
                                foreach ($this->extra["attributes"][$key]["widgetParams"]["fields"] as $key_field => $field_value ) {
                                    $this->$key_field = $field_value["value"];
                                    $this->$key_field = $extra["attributes"][$key]["widgetParams"]["fields"][$key_field]["value"] = $this->extra["attributes"][$key]["widgetParams"]["fields"][$key_field]["value"];
                                }
                            }
                        }
                    }
                    
                    // update "html_options"
                    if(isset($extra["html_options"], $this->extra["html_options"]) ) {
                        $extra["html_options"] = $this->extra["html_options"];
                    }
                    $this->extra = $extra;
                    //array_merge($extra, $this->extra);
                    
                } else {
                    $this->extra = $extra;
                }
                return true;
            }
            return false;
        }

        public function genetateModelFile($node_id = NULL)
        {
            $nid = (isset($this->node_id))? $this->node_id: $node_id;
            if($nid) {
                $nod = CckNode::model()->findByPk($nid);
                if($nod) {
                    $mod = new ModelsCode();
                    $mod->modelClass = StringFunctions::generateClassName($nod->machine_name);
                    $mod->tableName = $nod->machine_name;
                    $mod->prepare();
                    return $mod->save();
                }
            }
            throw new CHttpException(500,'An active or incorrect Form parent identificator.');
        }
        public function addFieldToTable($alter = false)
        {
            //$nod = CckNode::model()->findByPk($this->node_id);
            $nod = $this->cckNodeHasFields[0]->node;
            if($nod) {
                $command = Yii::app()->db->createCommand();
                $className = ucfirst($this->type).Yii::app()->controller->module->fieldClassSufix;
                $typeClass = new $className($this);
                $fieldType = $typeClass->getFieldType();
                $requred = ($this->requred)? " NOT NULL ": "";

                if(isset($this->maxlength))
                    $fieldType .= " (".$this->maxlength.") ";
                
                if($alter)
                    $command->alterColumn($nod->machine_name, $this->field_name, $fieldType.$requred);
                else
                    $command->addColumn($nod->machine_name, $this->field_name, $fieldType.$requred);

                $command->reset();
            } else
                throw new CHttpException(404,'An active Form identificator.');
        }


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'status' => 'Active',
			'field_label' => 'Field Label',
			'field_name' => 'Machine Name',
			'extra' => 'Extra',
			'default_values' => 'Default Values',
			'requred' => 'Requred',
			'values' => 'Values',
			'weight' => 'Weight',
			'is_php_value' => 'It will be Php Value',
			'is_php_def_value' => 'It will be Php Def Value',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
               // $this->setTableAlias("alt");
                $criteria->together = true;
                $criteria->with = array(
                        "cckNodeHasFields" => array(
                            //'joinType'=>'INNER JOIN',
                            "condition" => "cckNodeHasFields.node_id =".(int)$_GET["node_id"],
                        )
                    );
                $criteria->order = " t.weight ASC";
		$criteria->compare('id',$this->id);
		//$criteria->compare('node_id',$this->node_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('field_label',$this->field_label,true);
		$criteria->compare('field_name',$this->field_name,true);
		$criteria->compare('extra',$this->extra,true);
		$criteria->compare('default_values',$this->default_values,true);
		$criteria->compare('requred',$this->requred);
		$criteria->compare('values',$this->values,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('is_php_value',$this->is_php_value);
		$criteria->compare('is_php_def_value',$this->is_php_def_value);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}