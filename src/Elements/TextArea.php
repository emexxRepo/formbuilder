<?php
declare(strict_types=1);

namespace MajorFormBuilder\Elements;

use MajorFormBuilder\Abstracts\InputAbstract;

class TextArea extends InputAbstract
{
    private $textarea;
    private const STARTTEXTAREA = '<textarea';
    private const ENDTEXTAREA = '</textarea>';
    private $value;
    private $otherTextarea;

    public function __construct()
    {
        $this->textarea .= self::STARTTEXTAREA;
    }

    public function addRule(array $rules):InputAbstract
    {
        $this->checkSetValue();
        $this->textarea .= parent::addBaseRule($rules) . $this->otherTextarea;
        return $this;
    }

    private function checkSetValue() : void
    {
        $totalLength = mb_strlen($this->textarea, 'UTF-8');

        if (strstr($this->textarea, '>')) { // if set texatrea value
            $length = (int) 0;
            foreach (str_split($this->textarea) as $textarea) {
                if ($textarea == '>') {
                    break;
                }
                $length++;
            }

            $remainig = (int) $totalLength - $length;
            $textarea = mb_substr($this->textarea, 0, $length, 'UTF-8');
            $this->otherTextarea = mb_substr($this->textarea, $length, $remainig);
            $this->setEmpty();
            $this->textarea .= $textarea;
        }
    }

    private function setEmpty() : void
    {
        $this->textarea = '';
    }

    public function setName(string $name):InputAbstract
    {
        $this->checkSetValue();
        $this->textarea .= parent::setBaseName($name) . $this->otherTextarea;
        return $this;
    }

    public function addProperty(array $properties):InputAbstract
    {
        $this->checkSetValue();
        $this->textarea .= parent::addBaseProperty($properties) . $this->otherTextarea;

        return $this;
    }

    public function setValue(string $value): InputAbstract
    {
        $this->value = $value;
        $this->textarea .= ' >' . $value;
        return $this;
    }

    public function __toString() : string
    {
        $this->textarea .= self::ENDTEXTAREA;
        return $this->textarea;
    }
}
