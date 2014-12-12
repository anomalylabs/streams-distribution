<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Command;

use Way\Generators\Generator;

class GenerateStreamsFileCommandHandler
{

    protected $generator;

    function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function handle()
    {
        $template = app('streams.distribution.streams')->getPath('resources/assets/generator/streams.txt');

        $file = base_path('config/streams.php');

        @unlink($file);

        $this->generator->make($template, [], $file);
    }
}
 