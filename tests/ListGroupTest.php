<?php

use \Luluframework\Client\View\ListGroup;

class ListGroupTest extends \PHPUnit\Framework\TestCase
{
    public function testAddWithoutItem()
    {
        $this->expectException(ArgumentCountError::class);

        $listgroup = new ListGroup();
        $listgroup->add();
    }
    
    public function testAddWithItem()
    {

        $listgroup = new ListGroup();
        $this->assertEquals(true, $listgroup->add("Item test"));
    }

    public function testGet()
    {
        $l = new ListGroup();
        $this->assertInternalType('array', $l->get());
    }

    public function testSetWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);

        $l = new ListGroup();
        $l->set();
    }

    public function testSetWithGoodValue()
    {
        $l = new ListGroup();
        $this->assertEquals(true, $l->set(array(1, 2, 3)));
    }

    public function testSetWithBadValue()
    {
        $l = new ListGroup();
        $this->assertEquals(false, $l->set(12));
    }

    public function testHtml()
    {
        $l = new ListGroup();
        $this->assertInternalType('string', $l->html());
    }

    public function testHtmlWithGoodValue()
    {
        $l = new ListGroup();
        $this->assertInternalType('string', $l->html(ListGroup::HYPERLINK_LISTGROUP));
    }

    public function testHtmlWithBadValue()
    {
        $l = new ListGroup();
        $this->assertEquals(false, $l->html(3));
    }
}