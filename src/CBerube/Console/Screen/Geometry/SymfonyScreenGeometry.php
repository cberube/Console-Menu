<?php

namespace CBerube\Console\Screen\Geometry;

use Symfony\Component\Console\Application;

class SymfonyScreenGeometry implements IScreenGeometry
{
    const WIDTH_INDEX = 0;
    const HEIGHT_INDEX = 1;

    private $application;

    public static function getInstance(Application $application)
    {
        return new SymfonyScreenGeometry($application);
    }

    private function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function getWidth()
    {
        $dimensions = $this->application->getTerminalDimensions();
        return $dimensions[static::WIDTH_INDEX];
    }

    public function getHeight()
    {
        $dimensions = $this->application->getTerminalDimensions();
        return $dimensions[static::HEIGHT_INDEX];
    }

}
