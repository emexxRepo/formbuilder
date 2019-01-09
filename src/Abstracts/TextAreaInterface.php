<?php

namespace MajorFormBuilder\Abstracts;

interface TextAreaInterface extends InputInterface
{
    public function setValue(string $value): void;
}
