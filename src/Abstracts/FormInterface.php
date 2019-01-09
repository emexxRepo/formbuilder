<?php

namespace MajorFormBuilder\Abstracts;

interface FormInterface
{
    public function endForm():void;

    public function addElement(InputAbstract $input);

    public function __toString():string;
}
