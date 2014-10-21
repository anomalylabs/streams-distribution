<?php namespace Anomaly\Streams\Distribution\Base\Command;

use Anomaly\Streams\Platform\Generator\ConfigAppGenerator;

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
 