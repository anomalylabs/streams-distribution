<?php namespace Streams\Addon\Distribution\Base;

use Illuminate\Http\Request;
use Streams\Addon\Distribution\Base\Command\WriteAppFileCommand;
use Streams\Platform\Traits\CommandableTrait;

class BaseDistributionService
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
 