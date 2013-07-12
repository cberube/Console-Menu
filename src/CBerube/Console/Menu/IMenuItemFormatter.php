<?php

namespace CBerube\Console\Menu;

interface IMenuItemFormatter
{
    public function format(MenuGeometry $geometry, IMenu $menu, IMenuItem $item);
}
