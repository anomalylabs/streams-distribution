<?php namespace Anomaly\StreamsDistribution\Command;

use Way\Generators\Generator;

class GenerateDistributionFileCommandHandler
{

    protected $generator;

    function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function handle()
    {
        $template = app('streams.distribution.streams')->getPath('resources/assets/generator/distribution.txt');

        $file = base_path('config/distribution.php');

        @unlink($file);

        $this->generator->make($template, [], $file);
    }
}
 