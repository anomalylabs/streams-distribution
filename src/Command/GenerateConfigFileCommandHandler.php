<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Command;

use Way\Generators\Generator;

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

        $template = app('streams.path') . '/resources/assets/generator/config.txt';

        $file = base_path('config/app.php');

        @unlink($file);

        $this->generator->make($template, $data, $file);
    }
}
 