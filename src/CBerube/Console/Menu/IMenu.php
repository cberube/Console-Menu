<?php

namespace CBerube\Console\Menu;

interface IMenu extends \IteratorAggregate, \Countable
{
    /**
     * @param IMenuItem $item
     * @return void
     */
    public function addItem(IMenuItem $item);

    /**
     * @param string $key
     * @return MenuItem|null
     */
    public function getItemByKey($key);
}
