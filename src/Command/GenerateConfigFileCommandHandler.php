<?php namespace Streams\Addon\Distribution\Streams\Command;

use Streams\Platform\Support\Generator;

class GenerateConfigFileCommandHandler
{
    protected $generator;

    function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function handle(GenerateConfigFileCommand $command)
    {
        $key      = $command->getKey();
        $locale   = $command->getLocale();
        $timezone = $command->getTimezone();

        $data = compact('key', 'locale', 'timezone');

        $template = file_get_contents(streams_path('resources/assets/generator/config.txt'));

        $path = base_path('config/app.php');

        $this->generator->make($template, $data, $path);
    }
}
 