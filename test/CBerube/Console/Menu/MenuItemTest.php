<?php

namespace CBerube\Console\Menu;

class MenuItemTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $methodToValueMap = array(
            'key'           => md5(mt_rand()),
            'description'   => md5(mt_rand()),
            'value'         => md5(mt_rand()),
        );

        $item = new MenuItem();

        foreach ($methodToValueMap as $methodBaseName => $expectedValue) {
            $setMethod = 'set' . ucfirst($methodBaseName);
            $getMethod = 'get' . ucfirst($methodBaseName);

            $item->$setMethod($expectedValue);
            $this->assertEquals($expectedValue, $item->$getMethod());
        }
    }
}
