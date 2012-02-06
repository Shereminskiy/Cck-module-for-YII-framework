<?php
/**
 *  Display form type Item "Radio"
 * @author Alex Shereminskiy
 *
 */
class FormTypeCheckbox extends CWidget {

    public $fieldInfo = NULL;
    public $model = NULL;

    public function run() {
        if(!is_object($this->fieldInfo))
                $this->fieldInfo = (object)$this->fieldInfo;

        // need to apply default value for the model
        if($this->model) {
                $fieldName = $this->fieldInfo->field_name; // geting of field name and sets its default value
                $this->model->$fieldName = $this->fieldInfo->default_values;
        }

        $this->render('FormTypeCheckbox',array("fieldInfo" => $this->fieldInfo, "model" => $this->model));
    }

}