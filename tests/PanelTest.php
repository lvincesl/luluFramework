<?php

use \Luluframework\Client\View\Panel;

class PanelTest extends \PHPUnit\Framework\TestCase
{
    public function testSetHeaderWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $p = new Panel();
        $p->setHeader();
    }

    public function testSetHeaderWithGoodValue()
    {
        $p = new Panel();
        $this->assertEquals(true, $p->setHeader("Titre"));
    }

    public function testSetHeaderWithBadValue()
    {
        $p = new Panel();
        $this->assertEquals(false, $p->setHeader(12));
    }

    public function testGetHeader()
    {
        $p = new Panel();
        $this->assertEquals(null, $p->getHeader());

        $p->setHeader("Titre");
        $this->assertInternalType('string', $p->getHeader());
    }

    public function testSetBodyWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $p = new Panel();
        $p->setBody();
    }

    public function testSetBodyWithGoodValue()
    {
        $p = new Panel();
        $this->assertEquals(true, $p->setBody("Test"));
    }

    public function testSetBodyWithBadValue()
    {
        $p = new Panel();
        $this->assertEquals(false, $p->setBody(12));
    }

    public function testGetBody()
    {
        $p = new Panel();
        $this->assertEquals(null, $p->getBody());

        $p->setBody("Test");
        $this->assertInternalType('string', $p->getBody());
    }

    public function testSetFooterWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $p = new Panel();
        $p->setFooter();
    }

    public function testSetFooterWithGoodValue()
    {
        $p = new Panel();
        $this->assertEquals(true, $p->setFooter("Footer"));
    }

    public function testSetFooterWithBadValue()
    {
        $p = new Panel();
        $this->assertEquals(false, $p->setFooter(12));
    }

    public function testGetFooter()
    {
        $p = new Panel();
        $this->assertEquals(null, $p->getFooter());

        $p->setFooter("Footer");
        $this->assertInternalType('string', $p->getFooter());
    }

    public function testSetTypeWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $p = new Panel();
        $p->setType();
    }

    public function testSetTypeWithGoodValue()
    {
        $p = new Panel();
        $this->assertEquals(true, $p->setType(Panel::INFO));
    }

    public function testSetTypeWithBadValue()
    {
        $p = new Panel();
        $this->assertEquals(false, $p->setType(12));
    }

    public function testGetType()
    {
        $p = new Panel();
        $this->assertInternalType('integer', $p->getType());
    }

    public function testHtml()
    {
        $p = new Panel();
        $this->assertInternalType('string', $p->html());
    }
}