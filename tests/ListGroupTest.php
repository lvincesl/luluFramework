<?php


class ListGroupTest extends \PHPUnit\Framework\TestCase
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

    public function testGetItems()
    {

        $listgroup = new \Luluframework\Client\View\ListGroup();
        $this->assertInternalType('array', $listgroup->getItems());
    }

    public function testSetItemsWithoutItems()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);

        $listgroup = new \Luluframework\Client\View\ListGroup();
        $listgroup->setItems();
        $this->assertInternalType('array', $listgroup->getItems());
    }

    public function testSetItemsWithGoodItems()
    {

        $listgroup = new \Luluframework\Client\View\ListGroup();
        $array = array(1, 2, 3);
        $listgroup->setItems($array);
        $this->assertInternalType('array', $listgroup->getItems());
    }

    public function testSetItemsWithBadItems()
    {

        $listgroup = new \Luluframework\Client\View\ListGroup();
        
        $this->assertEquals(true, $listgroup->setItems(12));
    }

    public function testGetItemsAfterSetItemsWithBadItems()
    {

        $listgroup = new \Luluframework\Client\View\ListGroup();
        $listgroup->setItems(array(1, 2, 3));
        $this->assertInternalType('array', $listgroup->getItems());
    }

}