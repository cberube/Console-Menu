<?php

namespace CBerube\Console\Screen\Clear;

use CBerube\Console\Screen\Geometry\IScreenGeometry;
use Symfony\Component\Console\Output\OutputInterface;

class ShellClear implements IScreenClearOperation
{
    private $screenGeometry;

    public function __construct(IScreenGeometry $screenGeometry)
    {
        $this->screenGeometry = $screenGeometry;
    }

    public function clear(OutputInterface $output)
    {
        $lines = $this->screenGeometry->getHeight();

        $command = defined('PHP_WINDOWS_VERSION_BUILD') ? "mode con:lines=$lines" : 'clear';
        system($command);
    }
}
