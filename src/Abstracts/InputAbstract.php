<?php

namespace MajorFormBuilder\Abstracts;

abstract class InputAbstract
{
    protected $rules = [
        'maxlength' => null,
        'min' => null,
        'required' => false,
        'pattern' => null
    ];

    protected $properties = [
        'onclick',
        'disabled',
        'readonly',
        'size',
        'step',
        'placeholder',
        'autofocus',
        'class',
        'id',
        'style',
        'checked',
        'multiple',
        'accept',
        'name',
        'src',
        'width',
        'alt',
        'dirname'
    ];

    abstract public function __toString() : string;

    abstract public function setValue(string $value) : InputAbstract;

    public function addBaseProperty(array $properties):string
    {
        $input = '';
        foreach ($properties as $property => $val) {
            if (!in_array($property, $this->properties)) {
                throw new \ErrorException('Please enter a valid property');
            }
            $input .= ' ' . $property . '="' . $val . '"';
        }

        return $input;
    }

    public function addBaseRule(array $rules): string
    {
        $element = '';
        foreach ($rules as $rule => $val) {
            if (!array_key_exists($rule, $this->rules)) {
                throw new \ErrorException('Please enter Valid Rule Type' . $rule);
            }

            $element .= ' ' . $rule . '="' . $val . '"';
        }
        return $element;
    }

    protected function setBaseName(string $name) : string
    {
        return ' name="' . $name . '"';
    }
}
