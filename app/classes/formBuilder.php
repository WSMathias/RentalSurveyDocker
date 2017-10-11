<?php
class FormBuilder implements renderable {
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
        if ($title!=null){
            $formHtml .= "<h2>$title<h2>";
        }

        foreach ($this->$fields as $field){
            $type   = $field->getType();
            $name   = $field->getName();
            $value  = $field->getValue();
            $placeholder = $field->getPlaceholder();
            $id     = $field->getId();
            $class  =$field->getClass();
            $max    = $field->getMax();
            $min    = $field->getMin();
            $type   = ($type != null)?" type='$type'":"";
            $name   = ($name != null)?" name='$name'":"";
            $value  = ($value != null)?" value='$value'":"";
            $placeholder  = ($placeholder != null)?" placeholder='$placeholder'":"";          
            $id     = ($d!=null)?" id='$id'":"";
            $class  = ($class!=null)?" class='$class'":"";
            $max    = ($max != null)?" max='$max'":"";          
            $min    = ($min != null)?" min='$min'":"";
            $formHtml.="<input $type $name $value $placeholder $id $class $max $min >";            
        }
        $formHtml.="</form>";
    }
}