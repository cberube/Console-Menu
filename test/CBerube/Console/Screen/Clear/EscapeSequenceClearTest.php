<?php

namespace CBerube\Console\Screen\Clear;

class EscapeSequenceClearTest extends \PHPUnit_Framework_TestCase
{
    const EXPECTED_ESCAPE_SEQUENCE = "\033[2J";

    public function testClear()
    {
        $mockOutput = $this->getMockForAbstractClass('\\Symfony\\Component\\Console\\Output\\OutputInterface');

        $mockOutput
            ->expects($this->once())
            ->method('write')
            ->with(self::EXPECTED_ESCAPE_SEQUENCE);

        $escapeSequenceClear = new EscapeSequenceClear();

        $escapeSequenceClear->clear($mockOutput);
    }
}
