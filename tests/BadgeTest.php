<?php

use \Luluframework\Client\View\Badge;


class BadgeTest extends \PHPUnit\Framework\TestCase
{
    public function testGet()
    {
        $b = new Badge();
        $this->assertInternalType('integer', $b->get());
    }

    public function testSetWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $b = new Badge();
        $b->set();
    }

    public function testSetWithGoodValue()
    {
        $b = new Badge();
        $this->assertEquals(true, $b->set(12));
    }

    public function testSetWithBadValue()
    {
        $b = new Badge();
        $this->assertEquals(false, $b->set("12"));
    }

    public function testHtml()
    {
        $b = new Badge();
        $this->assertInternalType('string', $b->html());
    }
}