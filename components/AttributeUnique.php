<?php
/**
 *  Display header Manu
 * @author Alex Shereminskiy
 *
 */
class AttributeUnique extends AttributeWidget {
 	public function run() {
		$this->render('AttributeUnique',array("form" => $this->form , "model" => $this->model, "attributes" => $this->attributes));
	}
}