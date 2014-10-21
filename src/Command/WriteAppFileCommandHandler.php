<?php namespace Streams\Addon\Distribution\Base\Command;

use Streams\Platform\Generator\ConfigAppGenerator;

class WriteAppFileCommandHandler
{
    public function handle(WriteAppFileCommand $command)
    {
        $generator = new ConfigAppGenerator();

        $locale   = $command->getLocale();
        $timezone = $command->getTimezone();

        return $generator->make('foo', compact('locale', 'timezone'), true);
    }
}
 