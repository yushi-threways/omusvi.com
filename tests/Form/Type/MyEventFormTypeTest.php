<?php

namespace App\Tests\Form\Type;

use App\Form\Type\MyEventType;
use App\Entity\MyEvent;
use Symfony\Component\Form\Test\TypeTestCase;

class MyEventFormTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
    
        $formData = [
            'id' => 1,
            'name' => 'name',
            'description' => 'ディスディスディスディスディスディス',
            'content' => 'コンテンtぬコンテンtぬコンテンtぬコンテンtぬコンテンtぬ',
            'menPrice' => 1000,
            'womanPrice' => 10000,
            'createdAt' => new \DateTime(),
            'updatedAt' => new \DateTime(),
        ];

        $objectToCompare = new MyEvent();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(MyEventType::class, $objectToCompare);

        $object = new MyEvent();
        // ...populate $object properties with the data stored in $formData

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}