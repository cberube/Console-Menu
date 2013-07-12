<?php

namespace CBerube\Console\Menu;

class DefaultMenuItemFormatter implements IMenuItemFormatter
{
    public function format(MenuGeometry $geometry, IMenu $menu, IMenuItem $item)
    {
        $totalWidth = $geometry->getWidth();
        $totalItems = count($menu);

        $largestKeySize = strlen(strval($totalItems));

        $leftPaddingWidth = 1;
        $rightPaddingWidth = 1;
        $columnPaddingWidth = 1;
        $keySeparator = ')';

        $descriptionWidth =
            $totalWidth - $largestKeySize -
            $leftPaddingWidth - $rightPaddingWidth - $columnPaddingWidth - strlen($keySeparator);

        $leftPadding = str_repeat(' ', $leftPaddingWidth);
        $rightPadding = str_repeat(' ', $rightPaddingWidth);
        $columnPadding = str_repeat(' ', $columnPaddingWidth);

        $displayText = sprintf(
            "$leftPadding% {$largestKeySize}s%s$columnPadding% -{$descriptionWidth}s$rightPadding",
            $item->getKey(),
            $keySeparator,
            $item->getDescription()
        );

        return $displayText;
    }
}
