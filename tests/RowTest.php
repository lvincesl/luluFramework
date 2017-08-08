<?php


class TableRowTest extends \PHPUnit\Framework\TestCase
{
    public function testAddWithoutItem()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);

        $listgroup = new \Luluframework\Client\View\ListGroup();
        $listgroup->add();
    }
    
    public function testAddWithItem()
    {

        $listgroup = new \Luluframework\Client\View\ListGroup();
        $this->assertEquals(true, $listgroup->add("Item test"));
    }

    public function testGet()
    {

        $l = new \Luluframework\Client\View\ListGroup();
        $this->assertInternalType('array', $l->get());
    }

    public function testSetWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);

        $l = new \Luluframework\Client\View\ListGroup();
        $l->set();
    }

    public function testSetWithGoodValue()
    {

        $l = new \Luluframework\Client\View\ListGroup();
        $this->assertEquals(true, $l->set(array(1, 2, 3)));
    }

    public function testSetWithBadValue()
    {

        $l = new \Luluframework\Client\View\ListGroup();
        $this->assertEquals(false, $l->set(12));
    }

    public function testHtml()
    {
        $l = new \Luluframework\Client\View\ListGroup();
        $this->assertInternalType('string', $l->html());
    }

}