<?php

namespace CBerube\Console\Screen\Clear;

use Symfony\Component\Console\Output\OutputInterface;

interface IScreenClearOperation
{
    public function clear(OutputInterface $output);
}
