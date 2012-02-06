<?php
/**
 *  Display header Manu
 * @author Alex Shereminskiy
 *
 */
class AttributeWidget extends CWidget {

    /*
     * Contains link on form object
     */
    public $form;


    /*
     * Contains link on model object
     */
    public $model; 


    /* This parameters uses for containing various type and count of attributes.
     * For example it can contain label and/or description field.
     * It can contain
     */
    public $attributes = array();


}