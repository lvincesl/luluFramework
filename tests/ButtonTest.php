<?php

use \Luluframework\Client\View\Button;

class ButtonTest extends \PHPUnit\Framework\TestCase
{

    public function test__constructWithGoodValue()
    {
        $this->assertInstanceOf(Button::class, new Button('ok'));
    }

    public function test__constructWithBadValue()
    {
        $this->expectException(Exception::class);
        $b =  new Button(7);
    }

    public function testSetTextWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $b = new Button();
        $b->setText();
    }

    public function testSetTextWithGoodValue()
    {
        $b = new Button();
        $this->assertEquals(true, $b->setText('Ok'));
    }

    public function testSetTextWithBadValue()
    {
        $b = new Button();
        $this->assertEquals(false, $b->setText(12));
    }

    public function testGetText()
    {
        $b = new Button();
        $this->assertEquals(null, $b->getText());

        $b->setText('Ok');
        $this->assertInternalType('string', $b->getText());
    }

    public function testSetTooltipWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $b = new Button();
        $b->setTooltip();
    }

    public function testSetTooltipWithGoodValue()
    {
        $b = new Button();
        $this->assertEquals(true, $b->setTooltip('Ok'));
    }

    public function testSetTooltipWithBadValue()
    {
        $b = new Button();
        $this->assertEquals(false, $b->setTooltip(12));
    }

    public function testGetTooltip()
    {
        $b = new Button();
        $this->assertEquals(null, $b->getTooltip());

        $b->setTooltip('Ok');
        $this->assertInternalType('string', $b->getTooltip());
    }

    public function testSetClassWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $b = new Button();
        $b->setClass();
    }

    public function testSetClassWithGoodValue()
    {
        $b = new Button();
        $this->assertEquals(true, $b->setClass('active'));
    }

    public function testSetClassWithBadValue()
    {
        $b = new Button();
        $this->assertEquals(false, $b->setClass(12));
    }

    public function testSetTypeWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $b = new Button();
        $b->setType();
    }

    public function testSetTypeWithGoodValue()
    {
        $b = new Button();
        $this->assertEquals(true, $b->setType(Button::SUCCESS));
    }

    public function testSetTypeWithBadValue()
    {
        $b = new Button();
        $this->assertEquals(false, $b->setType('7'));
    }

    public function testGetType()
    {
        $b = new Button();
        $this->assertEquals(null, $b->getType());

        $b->setType(Button::SUCCESS);
        $this->assertInternalType('integer', $b->getType());
    }

    public function testGetClass()
    {
        $b = new Button();
        $this->assertEquals(null, $b->getClass());

        $b->setClass('active');
        $this->assertInternalType('string', $b->getClass());
    }

    public function testSetModalIdWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $b = new Button();
        $b->setModalId();
    }

    public function testSetModalIdWithGoodValue()
    {
        $b = new Button();
        $this->assertEquals(true, $b->setModalId("test"));
    }

    public function testSetModalIdWithBadValue()
    {
        $b = new Button();
        $this->assertEquals(false, $b->setModalId(7));
    }

    public function testGetModalId()
    {
        $b = new Button();
        $this->assertEquals(null, $b->getModalId());

        $b->setModalId("test");
        $this->assertInternalType('string', $b->getModalId());
    }

    public function testSetIdWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $b = new Button();
        $b->setId();
    }

    public function testSetIdWithGoodValue()
    {
        $b = new Button();
        $this->assertEquals(true, $b->setId("test"));
    }

    public function testSetIdWithBadValue()
    {
        $b = new Button();
        $this->assertEquals(false, $b->setId(7));
    }

    public function testGetId()
    {
        $b = new Button();
        $this->assertEquals(null, $b->getId());

        $b->setId("test");
        $this->assertInternalType('string', $b->getId());
    }

    public function testSetOnclickWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $b = new Button();
        $b->setModalId();
    }

    public function testSetOnclickWithGoodValue()
    {
        $b = new Button();
        $this->assertEquals(true, $b->setOnclick("test"));
    }

    public function testSetOnclickWithBadValue()
    {
        $b = new Button();
        $this->assertEquals(false, $b->setOnclick(7));
    }

    public function testGetOnclick()
    {
        $b = new Button();
        $this->assertEquals(null, $b->getOnclick());

        $b->setOnclick("test");
        $this->assertInternalType('string', $b->getOnclick());
    }

    public function testSetAdditionalPropertiesWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $b = new Button();
        $b->setAdditionalProperties();
    }

    public function testSetAdditionalPropertiesWithGoodValue()
    {
        $b = new Button();
        $this->assertEquals(true, $b->setAdditionalProperties("test"));
    }

    public function testSetAdditionalPropertiesWithBadValue()
    {
        $b = new Button();
        $this->assertEquals(false, $b->setAdditionalProperties(7));
    }

    public function testGetAdditionalProperties()
    {
        $b = new Button();
        $this->assertEquals(null, $b->getAdditionalProperties());

        $b->setAdditionalProperties("test");
        $this->assertInternalType('string', $b->getAdditionalProperties());
    }

    public function testHtml()
    {
        $b = new Button();
        $this->assertInternalType('string', $b->html());
    }
}