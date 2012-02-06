<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class FieldsCck
{
    protected $field_type = "TEXT";
    protected $field_lenth = 500;
    protected $nodeField = NUll;

    public function  __construct(CckNodeField $cnf) {
        if ($cnf instanceof CckNodeField)
            $this->nodeField = $cnf;
    }

    public static function parceValue($params)
    {
        $value = array();
        $temp = explode("\n", $params);
        foreach($temp as $single) {
            $par = explode("|", trim($single));
            if(isset ($par[0], $par[1]))
                $value[$par[0]] = $par[1];
        }
        $value = empty ($value)? $params: $value; // if value isn't array. Thus return string value.
        return $value;
    }
    public function setFieldLenth($lenth)
    {
        $this->field_lenth = $lenth;
    }

    public function getFieldLenth()
    {
        return $this->field_lenth;
    }

    public function setFieldType($type)
    {
        $this->field_type = $type;
    }
    public function getFieldType()
    {
        return $this->field_type;
    }

    public function getNodeField()
    {
        return $this->nodeField;
    }
    public static function getFormItem()
    {
        $form_items = array();
        $files = scandir(Yii::getPathOfAlias("cck.components.Fields"));
        foreach($files as $file) {
            if(strstr($file, 'FieldCck.php')) {
                list ($form_i, $ext) = explode("FieldCck.php", $file);
                $form_i = strtolower($form_i);
                $form_items[$form_i] = $form_i;
            }
        }
        return $form_items;
    }

    public function getExtraOptions()
    {
        return array(
                'html_options'  => '',
                "value_lenth"   => $this->getFieldLenth(),
                "display_machine_name_field" => true,
                "display_vafault_field" => true,
                "display_weight_field" => true,
                
        );
    }
    
}
