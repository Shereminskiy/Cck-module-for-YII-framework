<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CheckboxFieldCck extends FieldsCck
{
    public function  __construct(CckNodeField $cnf) {
        parent::__construct($cnf);
    }

    public function getExtraOptions()
    {
        return array(
                'html_options'  => '',
                "value_lenth"   => $this->getFieldLenth(),
                "display_machine_name_field" => true,
                "display_default_field" => true,
                "display_weight_field" => true,
        );
    }

}
