<?php

namespace CBeurbe\Console\Menu;

use CBerube\Console\Menu\Menu;

class MenuTest extends \PHPUnit_Framework_TestCase
{
    /** @var Menu */
    private $menu;

    public function setUp()
    {
        $this->menu = new Menu();
    }

    public function testAllPublicMethods()
    {
        $expectedItemCount = mt_rand(5, 10);
        $expectedItems = array();

        for ($i = 0; $i < $expectedItemCount; $i++) {
            $mockItem = $this->getMockForAbstractClass('\\CBerube\\Console\\Menu\\IMenuItem');
            $mockItem
                ->expects($this->once())
                ->method('getKey')
                ->will($this->returnValue($i));
            $this->menu->addItem($mockItem);

            $expectedItems[$i] = $mockItem;
        }

        $this->assertCount($expectedItemCount, $this->menu);
        $this->assertEquals($expectedItems, iterator_to_array($this->menu->getIterator()));

        foreach ($expectedItems as $expectedKey => $expectedItem) {
            $this->assertEquals($expectedItem, $this->menu->getItemByKey($expectedKey));
        }
    }
}
