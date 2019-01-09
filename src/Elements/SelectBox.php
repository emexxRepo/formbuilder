<?php

namespace MajorFormBuilder\Elements;

use MajorFormBuilder\Abstracts\InputAbstract;

class SelectBox extends InputAbstract
{
    private $selectBox;
    private const STARTOPTION = '<option';
    private const STARTSELECTBOX = '<select';
    private const ENDSELECTBOX = '</select>';
    private const ENDOPTION = '</option>';
    private $value;

    public function __construct()
    {
        $this->selectBox .= self::STARTSELECTBOX;
    }

    public function setOptions(array $options):InputAbstract
    {
        $this->selectBox .= '>';
        foreach ($options as $option) {
            if (is_array($option)) {
                $this->selectBox .= self::STARTOPTION;
                if (isset($option['properties'])) {
                    $this->selectBox .= parent::addBaseProperty($option['properties']);

                    if (isset($option['properties']['value'])) {
                        $this->setValue($option['name']);
                    }

                    if (isset($option['selected'])) {
                        $this->setSelectedValue();
                    }
                }
                if (isset($option['name'])) {
                    $this->setOptionName($option['name']);
                }

                $this->selectBox .= self::ENDOPTION;
            }
        }

        return $this;
    }

    private function setOptionName(string $name):void
    {
        $this->selectBox .= '>' . $name;
    }

    private function setSelectedValue():void
    {
        $this->selectBox .= ' selected';
    }

    public function addRule(array $rules):InputAbstract
    {
        $this->selectBox .= parent::addBaseRule($rules);
        return $this;
    }

    public function addProperty(array $properties):InputAbstract
    {
        $this->selectBox .= parent::addBaseProperty($properties);
        return $this;
    }

    public function setName(string $name):InputAbstract
    {
        $this->selectBox .= parent::setBaseName($name);
        return $this;
    }

    public function setValue(string $value):InputAbstract
    {
        $this->selectBox .= ' value="' . $value . '"';
        return $this;
    }

    public function __toString() : string
    {
        $this->selectBox .= self::ENDSELECTBOX;
        return $this->selectBox;
    }
}
