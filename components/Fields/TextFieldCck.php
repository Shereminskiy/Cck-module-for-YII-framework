<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class TextFieldCck extends FieldsCck
{
    public function  __construct(CckNodeField $cnf) {
        parent::__construct($cnf);
        $this->field_type = ' VARCHAR ';
    }

    public function getValidationRules()
    {
        return array();
    }
    public function getExtraOptions()
    {
        
        return array(
            "attributes" =>array(
//                "maxlength" =>array(
//                    "value" => 100,
//                    "label" => "Field Size max", // contains text description near the form element
//                    "type" => "textField", // type of the field
//                    "validate" =>  array (
//                        array('maxlength', 'numerical', 'allowEmpty'=>false, "max" => '255'),
//                        array('maxlength', 'required'),
//                        array('maxlength','compare','compareAttribute'=>'minlength','operator'=>'>', 'allowEmpty'=>false , 'message'=>'{attribute} must be greater than "{compareValue}".',),
//                    ),
//                ),
//                "minlength" =>array(
//                    "value" => 1,
//                    "label" => "Field Size min",
//                    "type" => "textField",
//                    "validate" =>  array (
//                        array('minlength', 'numerical', 'allowEmpty'=>false, "max" => '254'),
//                        array('minlength', 'required'),
//                        array('minlength','compare','compareAttribute'=>'maxlength','operator'=>'<', 'allowEmpty'=>false , 'message'=>'{attribute} must be lesser than "{compareValue}".',),
//                    ),
//                    "forValidate" => array ( // All fields are mondatory. This array uses fro generation validation rules in destination model file
//                        "name" => "length",  // contains name of default validator
//                        "paramName" => "min", // contains attribete neme, for mode information you can see about "length" validation rules
//                    ),
//                    "isActiveValidation" => true //declare that this parameter is available for adding in validation rules in the destination model class
//                ),
                "unique" => array(
                    "widget" => "AttributeUnique",
                    "widgetParams" => array(
                        "fields" => array(
                            "unique" => array(
                                "label" => Yii::t("cck", "Unique"),
                                "type" => "checkBox",
                                "description" => "Description for the field",
                                "value" => "1",
                            ),
                            "messageUnique" => array(
                                "label" => Yii::t("cck", "Unique error message"),
                                "type" => "textField",
                                "value" => Yii::t('yii',' This value has already been taken.'),
                                "description" => "Description for the fied",
                            ),
                        ),
                    ),
                    "validate" =>  array (
                        array('messageUnique', 'required'),
                        array('unique, messageUnique', 'safe'),
                    ),
                    "forValidate" => array ( // All fields are mondatory. This array uses fro generation validation rules in destination model file
                        "array('{{_field_name_}}', 'unique', 'message' =>  '{{_messageUnique_}}')",
                    ),
                    "isActiveValidation" => true //declare that this parameter is available for adding in validation rules in the destination model class
                )
            ),
            'html_options' => '',
            "value_requred" => false,
            "display_machine_name_field" => true,
            "display_default_field" => false,
            "display_weight_field" => true,

        );
    }
}
