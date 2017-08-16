<?php

use \Luluframework\Client\View\Alert;


class AlertTest extends \PHPUnit\Framework\TestCase
{
    public function testGet()
    {
        $a = new Alert();
        $this->assertEquals(null, $a->get());

        $a->set("12");
        $this->assertInternalType('string', $a->get());
    }

    public function testSetWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $a = new Alert();
        $a->set();
    }

    public function testSetWithGoodValue()
    {
        $a = new Alert();
        $this->assertEquals(true, $a->set("12"));
    }

    public function testSetWithBadValue()
    {
        $a = new Alert();
        $this->assertEquals(false, $a->set(12));
    }

    public function testDismissWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $a = new Alert();
        $a->dismiss();
    }

    public function testDismissWithGoodValue()
    {
        $a = new Alert();
        $this->assertEquals(true, $a->dismiss(true));
    }

    public function testDismissWithbADValue()
    {
        $a = new Alert();
        $this->assertEquals(false, $a->dismiss(7));
    }

    public function testHtml()
    {
        $a = new Alert();
        $this->assertInternalType('string', $a->html());
    }
}