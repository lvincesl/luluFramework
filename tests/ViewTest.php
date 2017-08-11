<?php

use \Luluframework\Client\View;

class ViewTest extends \PHPUnit\Framework\TestCase
{
    public function test__constructWithoutValue()
    {
        $this->assertInstanceOf(View::class, new View());
    }

    public function test__constructWithGoodValu()
    {
        $this->assertInstanceOf(View::class, new View(__DIR__."/ViewTest.php"));
    }

    public function test__constructWithBadValue()
    {
        $this->expectException(Error::class);
        $v = new View(12);
    }

    public function testSetPathWihoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $v = new View();
        $v->setPath();
    }

    public function testSetPathWithGoodValue()
    {
        $v = new View();
        $this->assertEquals(true, $v->setPath(__DIR__."/ViewTest.php"));
    }

    public function testSetPathWithBadValue()
    {
        $v = new View();
        $this->assertEquals(false, $v->setPath(12));
    }

    public function testGetPath()
    {
        $v = new View();
        $this->assertEquals(null, $v->getPath());

        $v->setPath(__DIR__."/ViewTest.php");
        $this->assertInternalType('string', $v->getPath());
    }

    public function testUpdateWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $v = new View(__DIR__."/ViewTest.php");
        $v->update();
    }

    public function testUpdateWithGoodValue()
    {
        $v = new View(__DIR__."/ViewTest.php");
        $this->assertEquals(true, $v->update("test"));
        $this->assertEquals(true, $v->update("test", "test2"));
    }

    public function testUpdateWithBadValue1()
    {
        $v = new View(__DIR__."/ViewTest.php");
        $this->assertEquals(false, $v->update(12));
    }

    public function testUpdateWithBadValue2()
    {
        $v = new View(__DIR__."/ViewTest.php");
        $this->assertEquals(false, $v->update("test", 12));
    }

    public function testHtml()
    {
        $v = new View();
        $this->assertEquals(null, $v->html());

        $v->setPath(__DIR__."/ViewTest.php");
        $this->assertInternalType('string', $v->html());
    }

    public function testDisplay()
    {
        $v = new View();
        $this->assertEquals(true, $v->display());
    }
}