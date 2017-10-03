<?php
class InputElement {
    protected $type;
    protected $name;
    protected $value;
    protected $placeholder;
    protected $id;
    protected $class;
    protected $max;
    protected $min;

    function __construct ($type=null,$name=null,$value=null,$placeholder=null){
        $this->$type = $type;
        $this->$name = $name;
        $this->$placeholder =$placeholder;
        $this->$value = $value;
        $this->$id=null;
        $this->$class = null;
        $this->$max = null;
        $this->$min = null; 
    }

    public function setType($type){
        $this->$type =$type;
    }
    public function getType(){
        return $this->$type;
    }

    public function setName($name){
        $this->$name = $name;
    }
    public function getName(){
        return $this->$name;
    }


    public function setValue($value){
        $this->$value = $value;
    }
    public function getValue(){
        return $this->$value;
    }

    public function setPlaceholder($placeholder){
        $this->$placeholder = $placeholder;
    }
    public function getPlaceholder(){
        return $this->$placeholder;
    }

    public function setId($id){
        $this->$id =$id;
    }
    public function getId($id){
        $this->$id =$id;
    }

    public function setClass($class){
        $this->$class =$class;
    }
    public function getClass($class){
        $this->$class =$class;
    }

    public function setMax($max){
        $this->$max =$max;
    }
    public function getMax($max){
        $this->$max =$max;
    }

    public function setMin($min){
        $this->$min =$min;
    }
    public function getMin($min){
        $this->$min =$min;
    }

}