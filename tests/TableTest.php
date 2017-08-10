<?php

use \Luluframework\Client\View\Table;
use \Luluframework\Client\View\Table\Row;

class TableTest extends \PHPUnit\Framework\TestCase
{
    public function testAddColWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $t = new Table();
        $t->addCol();
    }

    public function testAddColWithGoodValue()
    {
        $t = new Table();
        $this->assertEquals(true, $t->addCol("test"));
    }

    public function testAddCOlWithBadValue()
    {
        $t = new Table();
        $this->assertEquals(false, $t->addCol(12));
    }

    public function testSetCaptionWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $t = new Table();
        $t->setCaption();
    }

    public function testSetCaptionWithGoodValue()
    {
        $t = new Table();
        $this->assertEquals(true, $t->setCaption("Table test"));
    }

    public function testSetCaptionWithBadValue()
    {
        $t = new Table();
        $this->assertEquals(false, $t->setCaption(12));
    }

    public function testGetCaption()
    {
        $t = new Table();
        $this->assertEquals(null, $t->getCaption());

        $t->setCaption("Table test");
        $this->assertInternalType('string', $t->getCaption());
    }

    public function testSetHeaderWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $t = new Table();
        $t->setHeader();
    }

    public function testSetHeaderWithGoodValue()
    {
        $t = new Table();
        $this->assertEquals(true, $t->setHeader(array(1, 2, 3)));
    }

    public function testSetHeaderWithBadValue()
    {
        $t = new Table();
        $this->assertEquals(false, $t->setHeader(12));
    }

    public function testGetHeader()
    {
        $t = new Table();
        $this->assertInternalType('array', $t->getHeader());
    }

    public function testSetHeaderClassWithoutValue1()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $t = new Table();
        $t->setHeaderClass();
    }

    public function testSetHeaderClassWithoutValue2()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $t = new Table();
        $t->setHeaderClass("test");
    }

    public function testSetHeaderClassWithGoodValue()
    {
        $t = new Table();
        $this->assertEquals(true, $t->setHeaderClass("test", "active"));
    }

    public function testSetHeaderClassWithBadValue1()
    {
        $t = new Table();
        $this->assertEquals(false, $t->setHeaderClass(12, "active"));
    }

    public function testSetHeaderClassWithBadValue2()
    {
        $t = new Table();
        $this->assertEquals(false, $t->setHeaderClass("test", 12));
    }

    public function testGetHeaderClassWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $t = new Table();
        $t->getHeaderClass();
    }

    public function testGetHeaderClassWithGoodValue()
    {
        $t = new Table();
        $t->addCol("test");
        $t->setHeaderClass("test", "active");
        $this->assertInternalType('string', $t->getHeaderClass("test"));
    }

    public function testAddRowWithoutValue()
    {
        $this->expectException(TypeError::class);
        $t = new Table();
        $t->addRow();
    }

    public function testAddRowWithGoodValue()
    {
        $t = new Table();
        $this->assertEquals(true, $t->addRow(new Row("7")));
    }

    public function testAddRowWithBadValue()
    {
        $this->expectException(Exception::class);
        $t = new Table();
        $t->addRow(new Row(7));
    }

    public function testClear()
    {
        $t = new Table();
        $this->assertEquals(true, $t->clear());
    }

    public function testHasCheckboxWithGoodValue()
    {
        $t = new Table();
        $this->assertEquals(true, $t->hasCheckbox(true));
    }

    public function testHasCheckboxWithBadValue()
    {
        $t = new Table();
        $this->assertEquals(false, $t->hasCheckbox(12));
    }

    public function testSetFirstLineNumberWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $t = new Table();
        $t->setFirstLineNumber();
    }

    public function testSetFirstLineNumberWithGoodValue()
    {
        $t = new Table();
        $this->assertEquals(true, $t->setFirstLineNumber(12));
    }

    public function testSetFirstLineNumberWithBadValue()
    {
        $t = new Table();
        $this->assertEquals(false, $t->setFirstLineNumber("12"));
    }

    public function testGetFirstLineNumber()
    {
        $t = new Table();
        $this->assertEquals(null, $t->getFirstLineNumber());

        $t->setFirstLineNumber(12);
        $this->assertInternalType('integer', $t->getFirstLineNumber());
    }

    public function testSetCollapsedIndexWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $t = new Table();
        $t->setCollapsedIndex();
    }

    public function testSetCollapsedIndexWithGoodValue()
    {
        $t = new Table();
        $this->assertEquals(true, $t->setCollapsedIndex(12));
    }

    public function testSetCollapsedIndexWithBadValue()
    {
        $t = new Table();
        $this->assertEquals(false, $t->setCollapsedIndex("12"));
    }

    public function testGetCollapsedIndex()
    {
        $t = new Table();
        $this->assertEquals(null, $t->getCollapsedIndex());

        $t->setCollapsedIndex(12);
        $this->assertEquals(true, $t->getCollapsedIndex());
    }

    public function testHasOptionsWithGoodValue()
    {
        $t = new Table();
        $this->assertEquals(true, $t->hasOptions(true));
    }

    public function testHasCOptionsWithBadValue()
    {
        $t = new Table();
        $this->assertEquals(false, $t->hasOptions(12));
    }

    public function testSetClassWithoutValue()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $t = new Table();
        $t->setClass();
    }

    public function testSetClassWithGoodValue()
    {
        $t = new Table();
        $this->assertEquals(true, $t->setClass("active"));
    }

    public function testSetClassWithBadValue()
    {
        $t = new Table();
        $this->assertEquals(false, $t->setClass(12));
    }

    public function testGetClass()
    {
        $t = new Table();
        $this->assertEquals(null, $t->getClass());

        $t->setClass("active");
        $this->assertInternalType('string', $t->getClass());
    }

    public function testHtml()
    {
        $t = new Table();
        $this->assertInternalType('string', $t->html());
    }
}