<?php

namespace MajorFormBuilder\Elements;

use MajorFormBuilder\Abstracts\InputAbstract;

class Input extends InputAbstract
{
    private $types = [
        'color',
        'date',
        'datetime-local',
        'email',
        'month',
        'number',
        'range',
        'search',
        'tel',
        'time',
        'image',
        'range',
        'url',
        'week',
        'text',
        'password',
        'submit',
        'reset',
        'radio',
        'checkbox',
        'file',
        'hidden'
    ];

    private const STARTINPUT = '<input';

    private $input;

    public function addRule(array $rules):InputAbstract
    {
        $this->input .= parent::addBaseRule($rules);
        return $this;
    }

    public function setType(string $type):InputAbstract
    {
        if (!in_array($type, $this->types)) {
            throw new \ErrorException('Please enter a valid type');
        }

        $this->input .= self::STARTINPUT . ' type="' . $type . '"';

        return $this;
    }

    public function addProperty(array $properties):InputAbstract
    {
        $this->input .= parent::addBaseProperty($properties);

        return $this;
    }

    public function setValue(string $value):InputAbstract
    {
        $this->input .= ' value="' . $value . '"';

        return $this;
    }

    public function __toString() : string
    {
        $this->input .= '>';
        return $this->input;
    }
}
