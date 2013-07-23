<?php

namespace CBerube\Console\Menu;

class MenuGeometryTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $baseMethodNameList = array('width', 'height');

        $menuGeometry = new MenuGeometry();

        foreach ($baseMethodNameList as $baseMethodName) {
            $getter = 'get' . ucfirst($baseMethodName);
            $setter = 'set' . ucfirst($baseMethodName);
            $expectedValue = mt_rand();

            $menuGeometry->$setter($expectedValue);
            $this->assertEquals($expectedValue, $menuGeometry->$getter());
        }
    }
}
