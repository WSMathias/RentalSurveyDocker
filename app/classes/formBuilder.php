<?php
class formBuilder implements renderable {
    protected $title;
    protected $action;
    protected $method;
    protected $fields= array();
    function __construct($title=null,$action=null,$method="GET"){
        $this->$title = $title;
        $this->$action = $action;
        $this->$method = $method;
    }

    public function setTitle($title){
        $this->$title=$title;
    }

    public function setMethod($method){
        $this->$method = $method;
    }

    public function setAction($action){
        $this->$action = $action;
    }

    public function addField($field){
        $this->$fields[]=$field;
    }

    public function render(){
        $formHtml = "<form action='$this->$action' method='$this->$method'>";

        foreach ($this->$fields as $field){
            $type=$field->getType();
            $type = ($field->$type != null)?" type='$field->$type'":"";
            $name = $field->getName();
            $name  = ($field->$name != null)?" name='$field->$name'":"";
            $value = $field->getValue();
            $value  = ($field->$value != null)?" value='$field->$value'":"";
            $placeholder = $field->getPlaceholder();
            $placeholder  = ($field->$placeholder != null)?" placeholder='$field->$placeholder'":"";
            $id = $field->getId();
            $id = ($d!=null)?" id='$id'":"";
            $class =$field->getClass();
            $class = ($class!=null)?" class='$class'":"";
            $max = $field->getMax();
            $max  = ($field->$max != null)?" max='$field->$max'":"";
            $min = $field->getMin();
            $min  = ($field->$min != null)?" min='$field->$min'":"";
            //$formHtml.="<input type='$field->$type' name='$field->$name' placeholder='$field->$placeholder' value=
            
        }
        $formHtml.="</form>";
    }
}