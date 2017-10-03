<?php
interface form {
    public function fields ();
    public function submit();
    public function validate();
}    

interface renderable {
    public function render();   
}