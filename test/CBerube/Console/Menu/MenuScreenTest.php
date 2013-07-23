<?php

namespace CBerube\Console\Menu;

class MenuScreenTest extends \PHPUnit_Framework_TestCase
{
    /** @var MenuScreen */
    private $menuScreen;

    public function setUp()
    {
        $this->menuScreen = new MenuScreen();
    }

    public function testGetSetMenu()
    {
        $mockMenu = $this->getMockForAbstractClass('\\CBerube\\Console\\Menu\\IMenu');

        /** @var IMenu $mockMenu */
        $this->menuScreen->setMenu($mockMenu);
        $this->assertSame($mockMenu, $this->menuScreen->getMenu());
    }

    public function testGetSetHeader()
    {
        $expectedHeader = md5(mt_rand());

        $this->menuScreen->setHeader($expectedHeader);
        $this->assertEquals($expectedHeader, $this->menuScreen->getHeader());
    }

    public function testGetSetHeaderDivider()
    {
        $expectedDivider = substr(md5(mt_rand()), 0, 1);

        $this->menuScreen->setHeaderDivider($expectedDivider);
        $this->assertEquals($expectedDivider, $this->menuScreen->getHeaderDivider());
    }
}
