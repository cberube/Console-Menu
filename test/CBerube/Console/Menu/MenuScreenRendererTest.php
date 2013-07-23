<?php

namespace CBerube\Console\Menu;

use CBerube\Console\Screen\Clear\IScreenClearOperation;
use CBerube\Console\Screen\IScreen;
use Symfony\Component\Console\Output\OutputInterface;

class MenuScreenRendererTest extends \PHPUnit_Framework_TestCase
{
    /** @var MenuScreenRenderer */
    private $menuScreenRenderer;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $mockOutput;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $mockDialog;

    public function setUp()
    {
        $this->menuScreenRenderer = new MenuScreenRenderer();

        $this->mockOutput = $this->getMockForAbstractClass('\\Symfony\\Component\\Console\\Output\\OutputInterface');
        $this->mockDialog = $this->getMock('\\Symfony\\Component\\Console\\Helper\\DialogHelper');
    }

    public function testGetSetScreenClearOperation()
    {
        $mockScreenClear = $this->getMockForAbstractClass(
            '\\CBerube\\Console\\Screen\\Clear\\IScreenClearOperation'
        );

        /** @var IScreenClearOperation $mockScreenClear */
        $this->menuScreenRenderer->setClearOperation($mockScreenClear);
        $this->assertSame($mockScreenClear, $this->menuScreenRenderer->getClearOperation());
    }

    public function testRenderWithInvalidScreenType()
    {
        $mockScreen = $this->getMockForAbstractClass('\\CBerube\\Console\\Screen\\IScreen');

        $this->setExpectedException(
            '\\InvalidArgumentException',
            get_class($this->menuScreenRenderer) .
            " requires an instance of \\CBerube\\Console\\Menu\\MenuScreen but" .
            "was given an instance of " . get_class($mockScreen)
        );

        /** @var IScreen $mockScreen */
        $this->menuScreenRenderer->render($mockScreen, $this->mockOutput, $this->mockDialog);
    }

    public function testRenderAndGetSelectedItem()
    {
        $expectedMenuItemCount = mt_rand(5, 10);
        $expectedSelectedItemIndex = mt_rand();
        $expectedSelectedItem = md5(mt_rand());
        $expectedScreenWidth = mt_rand(50, 80);
        $expectedScreenHeight = mt_rand(20, 30);

        $mockScreenGeometry = $this->getMockForAbstractClass('\\CBerube\\Console\\Screen\\Geometry\\IScreenGeometry');
        $mockScreenGeometry
            ->expects($this->once())
            ->method('getWidth')
            ->will($this->returnValue($expectedScreenWidth));
        $mockScreenGeometry
            ->expects($this->once())
            ->method('getHeight')
            ->will($this->returnValue($expectedScreenHeight));

        $mockFormatter = $this->getMockForAbstractClass('\\CBerube\\Console\\Menu\\IMenuItemFormatter');

        $mockScreen = $this
            ->getMockBuilder('\\CBerube\\Console\\Menu\\MenuScreen')
            ->setMethods(array('getMenu'))
            ->getMock();

        $mockMenu = $this
            ->getMockBuilder('\\CBerube\\Console\\Menu\\IMenu')
            ->setMethods(array('getIterator'))
            ->getMockForAbstractClass();

        $mockMenuItemList = $this->buildMenuItemListForOutputTest(
            $mockFormatter,
            $expectedMenuItemCount
        );

        $mockMenu
            ->expects($this->once())
            ->method('getIterator')
            ->will($this->returnValue(new \ArrayIterator($mockMenuItemList)));

        $mockScreen
            ->expects($this->once())
            ->method('getMenu')
            ->will($this->returnValue($mockMenu));

        $this->mockDialog
            ->expects($this->once())
            ->method('ask')
            ->with($this->mockOutput, 'Enter your selection: ')
            ->will($this->returnValue($expectedSelectedItemIndex));

        $mockMenu
            ->expects($this->once())
            ->method('getItemByKey')
            ->with($expectedSelectedItemIndex)
            ->will($this->returnValue($expectedSelectedItem));

        /** @noinspection PhpParamsInspection */
        $this->menuScreenRenderer->setScreenGeometry($mockScreenGeometry);
        $this->menuScreenRenderer->setMenuItemFormatter($mockFormatter);
        $this->menuScreenRenderer->render($mockScreen, $this->mockOutput, $this->mockDialog);

        $actualSelectedItem = $this->menuScreenRenderer->getSelectedItem();
        $this->assertEquals($expectedSelectedItem, $actualSelectedItem);
    }

    /**
     * Builds a list of mock menu items and configures the mock formatter
     * to expect format calls for each item in sequence.
     *
     * @param \PHPUnit_Framework_MockObject_MockObject $mockFormatter
     * @param int $expectedMenuItemCount
     * @return array
     */
    private function buildMenuItemListForOutputTest($mockFormatter, $expectedMenuItemCount)
    {
        $menuItemList = array();

        for ($i = 0; $i < $expectedMenuItemCount; $i++) {
            $mockItem = $this->getMockForAbstractClass('\\CBerube\\Console\\Menu\\IMenuItem');
            $mockFormatter
                ->expects($this->at($i))
                ->method('format')
                ->with($this->anything(), $this->anything(), $mockItem);

            $menuItemList[$i] = $mockItem;
        }

        return $menuItemList;
    }
}
