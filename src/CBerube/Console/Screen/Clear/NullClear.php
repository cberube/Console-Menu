<?php

namespace CBerube\Console\Screen\Clear;

use Symfony\Component\Console\Output\OutputInterface;

class NullClear implements IScreenClearOperation
{
    public function clear(OutputInterface $output)
    {
        //  No-op
    }
}
