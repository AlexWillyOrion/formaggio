<?php

namespace Formaggio;

class Formaggio
{
    private $fields = [];
    private $formAttributes = [];

    public function __construct($action = "/", $method = "post", $attributes = [])
    {
        $this->formAttributes = $this->clearAttributesForm($attributes);
        $this->formAttributes["action"] = $action;
        $this->formAttributes["method"] = $method;
    }

    private function clearAttributesForm($attributes)
    {
        unset($attributes['action'], $attributes['method']);
        return $attributes;
    }

    public function getField($index = 0)
    {
        return $this->fields[$index] ?? null;
    }

    public function render()
    {
        echo $this->get() . PHP_EOL;
    }

    public function get()
    {
        return $this->getFormRendered($this->formAttributes);
    }

    private function getFormRendered($attributes = [])
    {
        $output = '<form ' . $this->buildAttributes($attributes) . '>';
        $output .= $this->getFieldsRendered($this->fields);
        $output .= '</form>';
        return $output;
    }

    private function buildAttributes($attributes)
    {
        $rawAttr = [];
        foreach ($attributes as $key => $value) {
            $rawAttr[] = $key . '="' . $value . '"';
        }
        return implode(' ', $rawAttr);
    }

    private function getFieldsRendered($fields)
    {
        $output = '';
        foreach ($fields as $field) {
            $output .= $this->getFieldRendered($field);
        }
        return $output;
    }

    private function getFieldRendered($field, $tag = 'input')
    {
        return "<$tag " . $this->buildAttributes($field) . '>';
    }

    public function text($name = "text", $attributes = array())
    {
        $attributes = $this->clearAttributesInput($attributes);
        $field = [
            "type" => 'text',
            "name" => $name
        ];
        $field = array_merge($field, $attributes);
        $this->fields[] = $field;
        return $this;
    }

    private function clearAttributesInput($attributes)
    {
        unset($attributes['name'], $attributes['type']);
        return $attributes;
    }

    public function email($name = "email", $attributes = array())
    {
        $attributes = $this->clearAttributesInput($attributes);
        $field = [
            "type" => 'email',
            "name" => $name
        ];
        $field = array_merge($field, $attributes);
        $this->fields[] = $field;
        return $this;
    }

    public function password($name = "password", $attributes = array())
    {
        $attributes = $this->clearAttributesInput($attributes);
        $field = [
            "type" => 'password',
            "name" => $name
        ];
        $field = array_merge($field, $attributes);
        $this->fields[] = $field;
        return $this;
    }

    public function place($placeholder)
    {
        $this->fields[count($this->fields) - 1]['placeholder'] = $placeholder;
        return $this;
    }
}