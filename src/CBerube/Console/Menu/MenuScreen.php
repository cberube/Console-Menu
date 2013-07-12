<?php

namespace CBerube\Console\Menu;

use CBerube\Console\Screen\IScreen;

class MenuScreen implements IScreen
{
    /** @var IMenu */
    private $menu;

    /** @var string */
    private $header;
    /** @var string */
    private $headerDivider;

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

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param string $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @return string
     */
    public function getHeaderDivider()
    {
        return $this->headerDivider;
    }

    /**
     * @param string $headerDivider
     */
    public function setHeaderDivider($headerDivider)
    {
        $this->headerDivider = $headerDivider;
    }
}
