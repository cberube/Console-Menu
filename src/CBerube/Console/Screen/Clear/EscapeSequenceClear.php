<?php

namespace CBerube\Console\Screen\Clear;

use Symfony\Component\Console\Output\OutputInterface;

class EscapeSequenceClear implements IScreenClearOperation
{
    public function clear(OutputInterface $output)
    {
        $output->write("\033[2J");
    }

}
