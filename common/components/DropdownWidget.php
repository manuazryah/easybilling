<?php
namespace common\components;

use yii\base\Widget;
use yii\helpers\Html;

class DropdownWidget extends Widget{
	public $field_name;
        public $model;
        public $id;
        public  $name;
        public  $table_name;

        public function init(){
                // add your logic here
	}
	
	public function run(){
		return $this->render('dropdown-search',['field_name' => $this->field_name,'model' =>$this->model,'id' => $this->id,'name' => $this->name,'table_name' => $this->table_name]);
	}
}
?>