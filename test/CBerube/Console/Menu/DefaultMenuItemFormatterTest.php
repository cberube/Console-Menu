<?php

namespace CBerube\Console\Menu;

class DefaultMenuItemFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormat()
    {
        // MD5 hash is 32 characters, plus 2 for left and right padding,
        // plus 2 for the key and key separator, plus 1 for column padding,
        // plus 3 spaces to ensure descriptions are padded
        $expectedWidth = 40;
        $expectedMenuItemCount = 1;
        $expectedItemDescription = md5(mt_rand());
        $expectedItemKey = mt_rand(1, 9);
        $expectedText = " $expectedItemKey) $expectedItemDescription    ";

        $mockMenuGeometry = $this->getMock('\\CBerube\\Console\\Menu\\MenuGeometry');
        $mockMenu = $this->getMockForAbstractClass('\\CBerube\\Console\\Menu\\IMenu');
        $mockMenuItem = $this->getMockForAbstractClass('\\CBerube\\Console\\Menu\\IMenuItem');

        $mockMenuGeometry
            ->expects($this->once())
            ->method('getWidth')
            ->will($this->returnValue($expectedWidth));

        $mockMenu
            ->expects($this->once())
            ->method('count')
            ->will($this->returnValue($expectedMenuItemCount));

        $mockMenuItem
            ->expects($this->once())
            ->method('getKey')
            ->will($this->returnValue($expectedItemKey));

        $mockMenuItem
            ->expects($this->once())
            ->method('getDescription')
            ->will($this->returnValue($expectedItemDescription));

        $formatter = new DefaultMenuItemFormatter();

        /** @noinspection PhpParamsInspection */
        $actualText = $formatter->format($mockMenuGeometry, $mockMenu, $mockMenuItem);
        $this->assertEquals($expectedText, $actualText);
    }
}
