<?php

/**
 * This is the model class for table "{{cck_node_has_field}}".
 *
 * The followings are the available columns in table '{{cck_node_has_field}}':
 * @property integer $node_id
 * @property integer $field_id
 *
 * The followings are the available model relations:
 * @property CckNodeField $field
 * @property CckNode $node
 */
class CckNodeHasField extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CckNodeHasField the static model class
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
		return '{{cck_node_has_field}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('node_id, field_id', 'required'),
			array('node_id, field_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('node_id, field_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'field' => array(self::BELONGS_TO, 'CckNodeField', 'field_id'),
			'node' => array(self::BELONGS_TO, 'CckNode', 'node_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'node_id' => 'Node',
			'field_id' => 'Field',
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
                $criteria->compare('id',$this->id);
		$criteria->compare('node_id',$this->node_id);
		$criteria->compare('field_id',$this->field_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}