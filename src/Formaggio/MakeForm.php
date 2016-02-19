<?php
namespace Formaggio;

class MakeForm
{
	private $fields  = [];
	private $action  = '';
	private $isRoute = '';
	private $method  = '';

    public function start($action = "/ciao", $method = "post", $isRoute = false)
    {
		$this->action  = $action;
		$this->method  = $method;
		$this->isRoute = $isRoute;
		
    }
    public function render()
    {
    	$raw = '';
    	$raw .= '<form action="'.$this->action.'" method="'.$this->method.'">'."\n";

    	foreach ($this->fields as $field) {
    		$raw .= '<input type="'.$field['type'].'" name="'.$field['name'].'"';
    		if(isset($field['placeholder']))
    			$raw .= ' placeholder="'.$field['placeholder'].'"';
    		$raw .= '>'."\n";
    	}

    	$raw .= '</form>'."\n";
    	echo $raw;
    }
    public function text($name="name")
    {
    	$field = [
    		"type" => 'text',
    		"name" => $name
    	];
    	$this->fields[] = $field;
    	return $this;
    }
    public function email($name="email")
    {
    	$field = [
    		"type" => 'email',
    		"name" => $name
    	];
    	$this->fields[] = $field;
    	return $this;
    }
    public function password($name="email")
    {
    	$field = [
    		"type" => 'password',
    		"name" => $name
    	];
    	$this->fields[] = $field;
    	return $this;
    }


    public function place($a)
    {
    	$this->fields[count($this->fields)-1]['placeholder'] = $a;
    	return $this;
    }
}