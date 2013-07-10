<?php

namespace CBerube\Console\Menu;

interface IMenuItem
{
    public function getKey();
    public function getDescription();
    public function getValue();
}
