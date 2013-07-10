<?php

namespace CBerube\Console\Menu;

use Traversable;

class Menu implements IMenu
{
    private $items = array();

    /**
     * @param IMenuItem $item
     * @return void
     */
    public function addItem(IMenuItem $item)
    {
        $this->items[$item->getKey()] = $item;
    }

    public function getItemByKey($key)
    {
        return $this->items[$key];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return count($this->items);
    }
}
