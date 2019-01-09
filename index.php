<?php
require 'vendor/autoload.php';

use MajorFormBuilder\Elements\Input;
use MajorFormBuilder\Elements\TextArea;
use MajorFormBuilder\Elements\SelectBox;
use MajorFormBuilder\Form;

echo $form = new Form(
    'foo.php',
    'post',
    ['id' => 'fooID', 'class' => 'fooClass'],
    'multipart/form-data'
    );
/* Result : <form id="fooID" class="fooClass" method="post" novalidate="0" autocomplete="off" action="foo.php" formenctype="multipart/form-data"> */

    echo $form->addElement(new SelectBox)
    ->setName('fooSelectBox')
    ->addProperty(['class' => 'fooCls', 'id' => 'fooId'])
    ->setOptions([
        [
            'name' => 'Audi',
            'value' => 'audi',
            'properties' => [
                'style' => 'color:red'
            ]
        ],

        [
            'name' => 'BMW',
            'properties' => [
                'class' => 'fooClass', 'id' => 'fooId', 'disabled' => 'disabled'
            ],
            'value' => 'bmw'
        ],

        [
            'name' => 'Fiat',
            'value' => 'fiat',
            'selected' => 'selected',
            'properties' => [
                'style' => 'background:pink'
            ]
        ]
    ]);

    /* Result : <select name="fooSelectBox" class="fooCls" id="fooId"><option style="color:red">Audi</option><option class="fooClass" id="fooId" disabled="disabled">BMW</option><option style="background:pink" selected>Fiat</option></select> */

//EXAMPLE TEXTAREA
echo $form->addElement(new TextArea)
          ->setValue('Lorem Ipsum dollar')
            ->addRule(['maxlength' => 25])
            ->setName('fooTextArea')
            ->addProperty(['style' => 'background:yellow']);

/* Result : <textarea  maxlength="25" name="fooTextArea" style="background:yellow">Lorem Ipsum dollar</textarea> */
// EXAMPLE :  INPUT TEXT
echo $form->addElement(new Input)
    ->setType('text')
    ->addProperty([
        'onclick' => 'alert(\'Im a alert\')',
        'placeholder' => 'Im placeholder',
        'disabled' => 'disabled',
        'readonly' => 'readonly',
        'class' => 'testClass',
        'id' => 'testId',
    ])->addRule(
        ['min' => 1, 'maxlength' => 25, 'required' => 'required']
    );

/* Result : <input type="text" onclick="alert('Im a alert')" placeholder="Im placeholder" disabled="disabled" readonly="readonly" class="testClass" id="testId" min="1" maxlength="25" required="required">
*/

//EXAMPLE : INPUT PASSWORD
echo $form->addElement(new Input)
                ->setType('password')
                ->addRule(['min' => 5, 'maxlength' => 10])
                ->setValue('testPassword')
                ->addProperty(['style' => 'background:red', 'alt' => 'fooAlt']);

/* Result :  <input type="password" min="5" maxlength="10" value="testPassword" style="background:red" alt="fooAlt"> */

//EXAMPLE : INPUT CHECKBOX
echo $form->addElement(new Input)
                        ->setType('checkbox')
                        ->setValue('checkBoxTestValue')
                        ->addProperty(['checked' => 'checked']);
/* Result : <input type="checkbox" value="checkBoxTestValue" checked="checked"> */

//EXAMPLE : INPUT RADIO
echo $form->addElement(new Input)
                        ->setType('radio')
                        ->setValue('radioTestValue')
                        ->addProperty(['checked' => 'checked']);
/* Result : <input type="radio" value="radioTestValue" checked="checked"> */

//EXAMPLE : INPUT FILE
echo $form->addElement(new Input)
                        ->setType('file')
                        ->addProperty(['multiple' => 'multiple', 'accept' => 'image/*', 'name' => 'fooName']);
/* Result : <input type="file" multiple="multiple" accept="image/*" name="fooName"> */

//EXAMPLE : INPUT SUBMIT
echo $form->addElement(new Input)
                ->setType('submit')
                    ->setValue('Submit Button');
/* Result <input type="submit" value="Submit Button"> */

echo $form->endForm();

/* Result : </form> */
