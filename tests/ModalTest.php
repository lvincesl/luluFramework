<?php

use \Luluframework\Client\View\Modal;

class ModalTest extends \PHPUnit\Framework\TestCase
{

    public function test__constructWithGoodValue()
    {
        $this->assertInstanceOf(Modal::class, new Modal('mymodal'));
    }

    public function testSetIdWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $m = new Modal('mymodal');
        $m->setId();
    }

    public function testSetIdWithGoodValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(true, $m->setId('mymodal2'));
    }

    public function testSetIdWithBadValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(false, $m->setId(12));
    }

    public function testGetId()
    {
        $m = new Modal('mymodal');
        $this->assertInternalType('string', $m->getId());
    }

    public function testCloseWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $m = new Modal('mymodal');
        $m->close();
    }

    public function testCloseWithGoodValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(true, $m->close(false));
    }

    public function testCloseWithBadValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(false, $m->close(7));
    }

    public function testSetTitleWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $m = new Modal('mymodal');
        $m->setTitle();
    }

    public function testSetTitleWithGoodValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(true, $m->setTitle('12'));
    }

    public function testSetTitleWithBadValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(false, $m->setTitle(12));
    }

    public function testGetTitle()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(null, $m->getTitle());

        $m->setTitle("Titre");
        $this->assertInternalType('string', $m->getTitle());
    }

    public function testSetBodyWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $m = new Modal('mymodal');
        $m->setBody();
    }

    public function testSetBodyWithGoodValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(true, $m->setBody("Test"));
    }

    public function testSetBodyWithBadValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(false, $m->setBody(12));
    }

    public function testGetBody()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(null, $m->getBody());

        $m->setBody("Test");
        $this->assertInternalType('string', $m->getBody());
    }

    public function testSetFooterWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $m = new Modal('mymodal');
        $m->setFooter();
    }

    public function testSetFooterWithGoodValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(true, $m->setFooter("Footer"));
    }

    public function testSetFooterWithBadValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(false, $m->setFooter(12));
    }

    public function testGetFooter()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(null, $m->getFooter());

        $m->setFooter("Footer");
        $this->assertInternalType('string', $m->getFooter());
    }

    public function testSetClassWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $m = new Modal('mymodal');
        $m->setClass();
    }

    public function testSetClassWithGoodValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(true, $m->setClass('active'));
    }

    public function testSetClassWithBadValue()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(false, $m->setClass(12));
    }

    public function testGetClass()
    {
        $m = new Modal('mymodal');
        $this->assertEquals(null, $m->getClass());

        $m->setClass('active');
        $this->assertInternalType('string', $m->getClass());
    }

    public function testHtml()
    {
        $m = new Modal('mymodal');
        $this->assertInternalType('string', $m->html());
    }
}