<?php

use \Luluframework\Client\View\Table\Row\Option;

class OptionTest extends \PHPUnit\Framework\TestCase
{
    public function test__constructWithGoodValue1()
    {
        $this->assertInstanceOf(Option::class, new Option(Option::VIEW, "7"));
    }

    public function test__constructWithBadValue1()
    {
        $this->expectException(Exception::class);
        $o = new Option(12, "7");
    }

    public function test__constructWithGoodValue2()
    {
        $this->assertInstanceOf(Option::class, new Option(Option::VIEW, "7"));
    }

    public function test__constructWithBadValue2()
    {
        $this->expectException(Exception::class);
        $o = new Option(Option::VIEW, 12);
    }

    public function test__constructWithGoodValue3()
    {
        $this->assertInstanceOf(Option::class, new Option(Option::VIEW, "7", "test/"));
    }

    public function test__constructWithBadValue3()
    {
        $this->expectException(Exception::class);
        $o = new Option(Option::VIEW, "7", 12);
    }

    public function testSetLinkWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $o = new Option(Option::VIEW, "7");
        $o->setLink();
    }

    public function testSetLinkWithGoodValue()
    {
        $o = new Option(Option::VIEW, "7");
        $this->assertEquals(true, $o->setLink("test/"));
    }

    public function testSetLinkWithBadValue()
    {
        $o = new Option(Option::VIEW, "7");
        $this->assertEquals(false, $o->setLink(12));
    }

    public function testGetLink()
    {
        $o = new Option(Option::VIEW, "7");
        $this->assertINternalType('null', $o->getLink());

        $o = new Option(Option::VIEW, "7", "test/");
        $this->assertINternalType('string', $o->getLink());
    }

    public function testHtml()
    {
        $o = new Option(Option::VIEW, "7");
        $this->assertInternalType('string', $o->html());
    }
}