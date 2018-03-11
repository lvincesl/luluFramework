<?php

use \Luluframework\Client\View\Label;


class LabelTest extends \PHPUnit\Framework\TestCase
{
    public function testGet()
    {
        $l = new Label();
        $this->assertEquals(null, $l->get());

        $l->set("12");
        $this->assertInternalType('string', $l->get());
    }

    public function testSetWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $l = new Label();
        $l->set();
    }

    public function testSetWithGoodValue()
    {
        $l = new Label();
        $this->assertEquals(true, $l->set("12"));
    }

    public function testSetWithBadValue()
    {
        $l = new Label();
        $this->assertEquals(false, $l->set(12));
    }

    public function testHtml()
    {
        $l = new Label();
        $this->assertInternalType('string', $l->html());
    }
}