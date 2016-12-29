<?php

namespace Formaggio;

/**
 * Class Formaggio
 * @package Formaggio
 */
class Formaggio
{
    /** @var array */
    private $fields = [];
    /** @var array */
    private $formAttributes = [];

    /**
     * Formaggio constructor.
     * @param string $action
     * @param string $method
     * @param array $attributes
     */
    public function __construct($action = "/", $method = "post", $attributes = [])
    {
        $this->formAttributes = $this->clearAttributesForm($attributes);
        $this->formAttributes["action"] = $action;
        $this->formAttributes["method"] = $method;
    }

    /**
     * @param $attributes
     * @return array
     */
    private function clearAttributesForm($attributes): array
    {
        unset($attributes['action'], $attributes['method']);
        return $attributes;
    }

    /**
     * @param int $index
     * @return mixed|null
     */
    public function getField($index = 0)
    {
        return $this->fields[$index] ?? null;
    }

    public function render()
    {
        echo $this->get() . PHP_EOL;
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->getFormRendered($this->formAttributes);
    }

    /**
     * @param array $attributes
     * @return string
     */
    private function getFormRendered($attributes = [])
    {
        $output = '<form ' . $this->buildAttributes($attributes) . '>';
        $output .= $this->getFieldsRendered($this->fields);
        $output .= '</form>';
        return $output;
    }

    /**
     * @param $attributes
     * @return string
     */
    private function buildAttributes($attributes)
    {
        $rawAttr = [];
        foreach ($attributes as $key => $value) {
            $rawAttr[] = $key . '="' . $value . '"';
        }
        return implode(' ', $rawAttr);
    }

    /**
     * @param $fields
     * @return string
     */
    private function getFieldsRendered($fields)
    {
        $output = '';
        foreach ($fields as $field) {
            $output .= $this->getFieldRendered($field);
        }
        return $output;
    }

    /**
     * @param $field
     * @param string $tag
     * @return string
     */
    private function getFieldRendered($field, $tag = 'input')
    {
        return "<$tag " . $this->buildAttributes($field) . '>';
    }

    /**
     * @param string $name
     * @param array $attributes
     * @return $this
     */
    public function text($name = "text", $attributes = array())
    {
        $this->addFieldByType('text', $name, $attributes);
        return $this;
    }

    private function addFieldByType($type, $name, $attributes)
    {
        $attributes = $this->clearAttributesInput($attributes);
        $field = [
            "type" => $type,
            "name" => $name,
        ];
        $field = array_merge($field, $attributes);
        $this->fields[] = $field;
    }

    /**
     * @param $attributes
     * @return mixed
     */
    private function clearAttributesInput($attributes)
    {
        unset($attributes['name'], $attributes['type']);
        return $attributes;
    }

    /**
     * @param string $name
     * @param array $attributes
     * @return $this
     */
    public function email($name = "email", $attributes = array())
    {
        $this->addFieldByType('email', $name, $attributes);
        return $this;
    }

    /**
     * @param string $name
     * @param array $attributes
     * @return $this
     */
    public function password($name = "password", $attributes = array())
    {
        $this->addFieldByType('password', $name, $attributes);
        return $this;
    }

    /**
     * @param $placeholder
     * @return $this
     */
    public function place($placeholder)
    {
        $this->fields[count($this->fields) - 1]['placeholder'] = $placeholder;
        return $this;
    }
}