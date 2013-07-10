<?php

namespace CBerube\Console\Menu;

use CBerube\Console\Screen\IScreen;

class MenuScreen implements IScreen
{
    /** @var IMenu */
    private $menu;

    /**
     * @return \CBerube\Console\Menu\IMenu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param \CBerube\Console\Menu\IMenu $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }
}
