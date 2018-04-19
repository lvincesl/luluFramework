<?php

use \Luluframework\Client\View\Table\Row;
use \Luluframework\Client\View\Table\Row\Option;

class TableRowTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructorWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row();
    }

    public function testAddCellWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->addCell();
    }

    public function testAddCellWithGoodValue()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->addCell("12"));
    }

    public function testAddCellWithBadValue()
    {
        $r = new Row("7");
        $this->assertEquals(false, $r->addCell(12));
    }

    public function testDelCellWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->delCell();
    }

    public function testDelCellWithGoodValue()
    {
        $r = new Row("7");
        $r->addCell("12");
        $this->assertEquals(true, $r->delCell(0));
    }

    public function testDelCellWithBadValue()
    {
        $r = new Row("7");
        $r->addCell("12");
        $this->assertEquals(false, $r->delCell(1));
    }

    public function testGetCellWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->delCell();
    }

    public function testGetCellWithGoodValue()
    {
        $r = new Row("7");
        $r->addCell("12");
        $this->assertInternalType('string', $r->getCell(0));
    }

    public function testGetCellWithBadValue()
    {
        $r = new Row("7");
        $r->addCell("12");
        $this->assertEquals(false, $r->getCell(1));
    }

    public function testSetCellsWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->setCells();
    }

    public function testSetCellsWithGoodValue()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->setCells(array(1, 2 , 3)));
    }

    public function testSetCellsWithBadValue()
    {
        $r = new Row("7");
        $this->assertEquals(false, $r->setCells(12));
    }

    public function testGetCells()
    {
        $r = new Row("7");
        $this->assertInternalType('array', $r->getCells());
    }

    public function testSetIdWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->setId();
    }

    public function testSetIdWithGoodValue()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->setId(12));
    }

    public function testSetIdWithBadValue()
    {
        $r = new Row("7");
        $this->assertEquals(false, $r->setId(true));
    }

    public function testGetId()
    {
        $r = new Row("7");
        $this->assertInternalType('string', $r->getId());
    }

    public function testAddOptionWithoutValue()
    {
        $this->expectException(TypeError::class);
        $r = new Row("7");
        $r->addOption();
    }

    public function testAddOptionWithGoodValue()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->addOption(new Option(Option::VIEW, $r->getId())));
    }

    public function testAddOptionWithBadValue()
    {
        $this->expectException(TypeError::class);
        $r = new Row("7");
        $r->addOption(12);

    }

    public function testSetLineNumberWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->setLineNumber();
    }

    public function testSetLineNumberWithGoodValue()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->setLineNumber(12));
    }

    public function testSetLineNumberWithBadValue()
    {
        $r = new Row("7");
        $this->assertEquals(false, $r->setLineNumber(true));
    }

    public function testGetLineNumber()
    {
        $r = new Row("7");
        $this->assertEquals(null, $r->getLineNumber());

        $r->setLineNumber(12);
        $this->assertInternalType('integer', $r->getLineNumber());
    }

    public function testHasCheckboxWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->hasCheckbox();
    }

    public function testHasCheckboxWithGoodValue()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->hasCheckbox(true));
    }

    public function testHasCheckboxWithBadValue()
    {
        $r = new Row("7");
        $this->assertEquals(false, $r->hasCheckbox(12));
    }

    public function testSetClassWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->setClass();
    }

    public function testSetClassWithGoodValue()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->setClass("active"));
    }

    public function testSetClassWithBadValue()
    {
        $r = new Row("7");
        $this->assertEquals(false, $r->setClass(12));
    }

    public function testGetClass()
    {
        $r = new Row("7");
        $this->assertEquals(null, $r->getClass());

        $r->setClass("active");
        $this->assertInternalType('string', $r->getClass());
    }

    public function testSetCellsClassWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->setCellsClass();
    }

    public function testSetCellsClassWithGoodValue()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->setCellsClass(array("test" => "active")));
    }

    public function testSetCellsClassWithBadValue()
    {
        $r = new Row("7");
        $this->assertEquals(false, $r->setCellsClass(12));
    }

    public function testGetCellsClass()
    {
        $r = new Row("7");
        $this->assertEquals(null, $r->getCellsClass());

        $r->setCellsClass(array("test" => "active"));
        $this->assertInternalType('array', $r->getCellsClass());
    }

    public function testSetCellsColspanWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->setCellsColspan();
    }

    public function testSetCellsColspanWithGoodValue()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->setCellsColspan(array("test" => 3)));
    }

    public function testSetCellsColspanWithBadValue()
    {
        $r = new Row("7");
        $this->assertEquals(false, $r->setCellsColspan(12));
    }

    public function testGetCellsColspan()
    {
        $r = new Row("7");
        $this->assertEquals(null, $r->getCellsColspan());

        $r->setCellsColspan(array("test" => 2));
        $this->assertInternalType('array', $r->getCellsColspan());
    }

    public function testSetCellsRowspanWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->setCellsRowspan();
    }

    public function testSetCellsRowspanWithGoodValue()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->setCellsRowspan(array("test" => 2)));
    }

    public function testSetCellsRowspanWithBadValue()
    {
        $r = new Row("7");
        $this->assertEquals(false, $r->setCellsRowspan(12));
    }

    public function testGetCellsRowspan()
    {
        $r = new Row("7");
        $this->assertEquals(null, $r->getCellsRowspan());

        $r->setCellsRowspan(array("test" => 2));
        $this->assertInternalType('array', $r->getCellsRowspan());
    }

    public function testSetCollapseIdWithoutValue()
    {
        $this->expectException(ArgumentCountError::class);
        $r = new Row("7");
        $r->setCollapseId();
    }

    public function testSetCollapseIdWithGoodValue()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->setCollapseId("12"));
    }

    public function testSetCollapseIdWithBadValue()
    {
        $r = new Row("7");
        $this->assertEquals(false, $r->setCollapseId(12));
    }

    public function testGetCollapseId()
    {
        $r = new Row("7");
        $this->assertEquals(null, $r->getCollapseId());

        $r->setCollapseId("12");
        $this->assertInternalType('string', $r->getCollapseId());
    }

    public function testHtml()
    {
        $r = new Row("7");
        $this->assertInternalType('string', $r->html());
    }

    public function testClear()
    {
        $r = new Row("7");
        $this->assertEquals(true, $r->clear());
    }
}