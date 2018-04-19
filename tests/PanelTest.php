<?php

use \Luluframework\Client\View\Panel;

class PanelTest extends \PHPUnit\Framework\TestCase
{
    public function testSetHeaderWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
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
        $this->expectException(ArgumentCountError::class);
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
        $this->expectException(ArgumentCountError::class);
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
        $this->expectException(ArgumentCountError::class);
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
    
    public function testSetClassWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $p = new Panel();
        $p->setClass();
    }

    public function testSetClassWithGoodValue()
    {
        $p = new Panel();
        $this->assertEquals(true, $p->setClass("Footer"));
    }

    public function testSetClassWithBadValue()
    {
        $p = new Panel();
        $this->assertEquals(false, $p->setClass(12));
    }

    public function testGetClass()
    {
        $p = new Panel();
        $this->assertEquals(null, $p->getClass());

        $p->setClass("Footer");
        $this->assertInternalType('string', $p->getClass());
    }

    public function testSetHeaderClassWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $p = new Panel();
        $p->setHeaderClass();
    }

    public function testSetHeaderClassWithGoodValue()
    {
        $p = new Panel();
        $this->assertEquals(true, $p->setHeaderClass("Titre"));
    }

    public function testSetHeaderClassWithBadValue()
    {
        $p = new Panel();
        $this->assertEquals(false, $p->setHeaderClass(12));
    }

    public function testGetHeaderClass()
    {
        $p = new Panel();
        $this->assertEquals(null, $p->getHeaderClass());

        $p->setHeader("Titre");
        $this->assertInternalType('string', $p->getHeader());
    }

    public function testSetBodyClassWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $p = new Panel();
        $p->setBodyClass();
    }

    public function testSetBodyClassWithGoodValue()
    {
        $p = new Panel();
        $this->assertEquals(true, $p->setBodyClass("Test"));
    }

    public function testSetBodyClassWithBadValue()
    {
        $p = new Panel();
        $this->assertEquals(false, $p->setBodyClass(12));
    }

    public function testGetBodyClass()
    {
        $p = new Panel();
        $this->assertEquals(null, $p->getBodyClass());

        $p->setBodyClass("Test");
        $this->assertInternalType('string', $p->getBodyClass());
    }

    public function testSetFooterClassWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $p = new Panel();
        $p->setFooterClass();
    }

    public function testSetFooterClassWithGoodValue()
    {
        $p = new Panel();
        $this->assertEquals(true, $p->setFooterClass("Footer"));
    }

    public function testSetFooterClassWithBadValue()
    {
        $p = new Panel();
        $this->assertEquals(false, $p->setFooterClass(12));
    }

    public function testGetFooterClass()
    {
        $p = new Panel();
        $this->assertEquals(null, $p->getFooterClass());

        $p->setFooterClass("Footer");
        $this->assertInternalType('string', $p->getFooterClass());
    }

    public function testSetRefreshWidgetVisibleWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $p = new Panel();
        $p->setRefreshWidgetVisible();
    }

    public function testSetRefreshWidgetVisibleWithGoodValue()
    {
        $p = new Panel();
        $this->assertEquals(true, $p->setRefreshWidgetVisible(true));
    }

    public function testSetRefreshWidgetVisibleWithBadValue()
    {
        $p = new Panel();
        $this->assertEquals(false, $p->setRefreshWidgetVisible(12));
    }

    public function testGetRefreshWidgetVisibleClass()
    {
        $p = new Panel();
        $this->assertEquals(false, $p->getRefreshWidgetVisible());

        $p->setRefreshWidgetVisible(true);
        $this->assertInternalType('boolean', $p->getRefreshWidgetVisible());
    }

    public function testHtml()
    {
        $p = new Panel();
        $this->assertInternalType('string', $p->html());
    }
}