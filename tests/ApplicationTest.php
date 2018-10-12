<?php
require "MyApplication.php";


class ApplicationTest extends \PHPUnit\Framework\TestCase
{
    public function testUseHtmlFrameworkWithoutValue()
    {
        $app = new \tests\MyApplication();
        $this->expectException(ArgumentCountError::class);
        $app->useHtmlFramework();
    }

    public function testUseHtmlFrameworkGoodValue()
    {
        $app = new \tests\MyApplication();
        $this->assertEquals(true, $app->useHtmlFramework(\Luluframework\HtmlFramework::BOOTSTRAP_4));
    }

    public function testUseHtmlFrameworkBadValue()
    {
        $app = new \tests\MyApplication();
        $this->assertEquals(false, $app->useHtmlFramework("ok"));
    }
}