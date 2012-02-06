<?php

/**
 * This is the model class for table "{{cck_node}}".
 *
 * The followings are the available columns in table '{{cck_node}}':
 * @property integer $id
 * @property string $title
 * @property string $machine_name
 *
 * The followings are the available model relations:
 * @property CckNodeField[] $cckNodeFields
 */
class CckNode extends CActiveRecord
{

    	public $title;
	public $machine_name;

        protected $form_prefix = "form__";

        public function  __construct($scenario = 'insert') {
            parent::__construct($scenario);
            $this->form_prefix = Yii::app()->db->tablePrefix.$this->form_prefix;
        }

        /**
	 * Returns the static model of the specified AR class.
	 * @return CckNode the static model class
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
		return '{{cck_node}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('title, machine_name', 'required'),
			array('title, machine_name', 'length', 'max'=>100),
                        array('machine_name', 'unique', 'on' => 'create'),
                        array('machine_name', 'validateUniqueTableName', 'on' => 'create'),
			array('id, title, machine_name', 'safe', 'on'=>'search'),
		);
	}


        public function validateUniqueTableName($attribute,$params)
        {
            $invalidColumns=array();
            if (($pos=strrpos($this->machine_name,'.'))!==false)
                $schema=substr($this->machine_name,0,$pos);
            else
                $schema='';

            $tables=Yii::app()->db->schema->getTables($schema);
            if ($this->machine_name) {
                foreach($tables as $key => $table) {
                    if($key === $this->machine_name) {
                        $this->addError('machine_name',"Table '{$this->machine_name}' does exist.");
                        return false;
                    }
                }
                return true;
            }
            return false;
        }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                        'cckNodeHasFields' => array(self::HAS_MANY, 'CckNodeHasField', 'node_id'),
		);
	}

        /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'machine_name' => 'Machine Name',
		);
	}

        public function createFormTable()
        {
                $command = Yii::app()->db->createCommand();
                $command->createTable($this->machine_name, array(
                    'id' => 'pk',
                    'node_id' => 'INTEGER NOT NULL',
                    ), 'ENGINE=InnoDB'
                );
                $command->reset();  // clean up the previous query
                $command->createIndex($this->machine_name.'_node_id'.rand(1, 10000), $this->machine_name, "node_id");
                $command->reset();  // clean up the previous query
                $command->addForeignKey('fk_form_node_'.$this->machine_name.rand(1, 10000), $this->machine_name, 'node_id', $this->tableName(), 'id', 'CASCADE', 'CASCADE');
                $command->reset();  // clean up the previous query
                return true;
        }

        public function deleteFormTable()
        {
            $module=Yii::app()->controller->module;
            $command = Yii::app()->db->createCommand();
            try {
                $fileName = Yii::getPathOfAlias($module->pathToModels). "/".StringFunctions::generateClassName($this->machine_name).".php";
                @unlink($fileName);
                $command->dropTable($this->machine_name);
                $command->reset();
            } catch (Exception $e) {
                Yii::log("Catch Exaption in commant 'command->dropTable(".$this->machine_name.")'.  ".$e->getMessage(), 'error');
            }
        }
        public function beforeValidate()
        {
//            $this->machine_name = preg_replace("/\W/", "_", $this->attributes["machine_name"]);
            $this->machine_name = StringFunctions::seo_url($this->machine_name, '_');
            if(!preg_match("/^".$this->form_prefix."/", $this->machine_name))
                $this->machine_name =  $this->form_prefix.$this->machine_name;

            return parent::beforeValidate();
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('machine_name',$this->machine_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function getFormPrefix()
        {
            return $this->form_prefix;
        }

        public function setFormPrefix($prefix)
        {
            $this->form_prefix = $prefix;
        }
}