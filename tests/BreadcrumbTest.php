<?php


class BreadcrumbTest extends \PHPUnit\Framework\TestCase
{
    public function testGet()
    {
        $b = new \Luluframework\Client\View\Breadcrumb();
        $this->assertInternalType('array', $b->get());
    }

    public function testSetWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        
        $b = new \Luluframework\Client\View\Breadcrumb();
        $b->set();
    }

    public function testSetWithBadValue1()
    {
        $b = new \Luluframework\Client\View\Breadcrumb();
        $this->assertEquals(false, $b->set(12));
    }

    public function testSetWithBadValue2()
    {
        $b = new \Luluframework\Client\View\Breadcrumb();
        $this->assertEquals(false, $b->set(array(12)));
    }

    public function testSetWithGoodValue()
    {
        $b = new \Luluframework\Client\View\Breadcrumb();
        $this->assertEquals(true, $b->set(array("yes" => null)));
    }

    public function testAddWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        
        $b = new \Luluframework\Client\View\Breadcrumb();
        $b->add();
    }

    public function testAddWithBadValue1()
    {
        $b = new \Luluframework\Client\View\Breadcrumb();
        $this->assertEquals(false, $b->add(12));
    }

    public function testAddWithBadValue2()
    {
        $b = new \Luluframework\Client\View\Breadcrumb();
        $this->assertEquals(false, $b->add("Page 1", 12));
    }

    public function testAddWithGoodValue()
    {
        $b = new \Luluframework\Client\View\Breadcrumb();
        $this->assertEquals(true, $b->add("Page 1", "/page1"));
    }

    public function testHtml()
    {
        $b = new \Luluframework\Client\View\Breadcrumb();
        $this->assertInternalType('string', $b->html());
    }

}