<?php
/**
 *  Display header Menu
 * @author Alex Shereminskiy
 *
 */
class FormItemsList extends CWidget {

    public function run() {
        $this->render('FormItemsList',array("select_items" => FieldsCck::getFormItem()));
    }

}