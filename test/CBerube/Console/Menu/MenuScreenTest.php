<?php

namespace CBerube\Console\Menu;

class MenuScreenTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSetMenu()
    {
        $mockMenu = $this->getMockForAbstractClass('\\CBerube\\Console\\Menu\\IMenu');

        $menuScreen = new MenuScreen();

        /** @var IMenu $mockMenu */
        $menuScreen->setMenu($mockMenu);
        $this->assertSame($mockMenu, $menuScreen->getMenu());
    }
}
