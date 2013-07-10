<?php

namespace CBerube\Console\Screen;

use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Output\OutputInterface;

interface IScreenRenderer
{
    public function render(IScreen $screen, OutputInterface $output, DialogHelper $dialog);
}
