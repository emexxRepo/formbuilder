<?php

namespace MajorFormBuilder;

use MajorFormBuilder\Abstracts\FormInterface;
use MajorFormBuilder\Abstracts\InputAbstract;

final class Form implements FormInterface
{
    private $input;
    private $styles = [
        'class' => null,
        'id' => null,
        'style' => null
    ];

    private const FORMSTART = '<form';
    private const FORMEND = '</form>';
    private $form;

    private $formBeginProperties = [
        'method' => 'GET',
        'novalidate' => 0,
        'autocomplete' => 'off',
        'action',
        'formenctype',
    ];

    public function __construct(string $action, string $method, array $style = [], string $formenctype = null, string $autoComplate = null, bool $novalidate = false)
    {
        $this->form = self::FORMSTART;
        $this->formBeginProperties['action'] = $action;
        $this->formBeginProperties['method'] = $method;
        if (!is_null($formenctype)) {
            $this->formBeginProperties['formenctype'] = $formenctype;
        }
        if ($novalidate === true) {
            $this->formBeginProperties['novalidate'] = 'novalidate';
        }

        if (!empty($style)) {
            $this->setStyle($style);
        }

        $this->setForm();
    }

    private function setForm():void
    {
        foreach ($this->formBeginProperties as $form => $value) {
            if (!is_numeric($form)) {
                $this->form .= ' ' . $form . '="' . $value . '"';
            }
        }

        $this->form .= '>';
    }

    private function setStyle(array $style):void
    {
        foreach ($style as $index => $val) {
            if (!array_key_exists($index, $this->styles)) {
                echo $index;
                throw new \ErrorException('please enter a valid style type');
            }

            $this->form .= ' ' . $index . '="' . $val . '"';
        }
    }

    public function addElement(InputAbstract $input)
    {
        return $this->input = new $input();
    }

    public function __toString():string
    {
        return $this->form;
    }

    public function endForm():void
    {
        echo  self::FORMEND;
    }
}
