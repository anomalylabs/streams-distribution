<?php namespace Anomaly\Streams\Distribution\Streams;

use Illuminate\Http\Request;
use Anomaly\Streams\Distribution\Streams\Command\WriteAppFileCommand;
use Anomaly\Streams\Platform\Traits\CommandableTrait;

class StreamsDistributionService
{
    use CommandableTrait;

    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function install()
    {
        $this->writeConfigFile();

        return true;
    }

    private function writeConfigFile()
    {
        $locale   = 'en';
        $timezone = 'UTC';

        $command = new WriteAppFileCommand($locale, $timezone);

        $this->execute($command);
    }
}
 