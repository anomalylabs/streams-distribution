<?php namespace Anomaly\StreamsDistribution\Command;

use Anomaly\StreamsDistribution\StreamsDistribution;
use Way\Generators\Generator;

class GenerateDistributionFileCommandHandler
{

    protected $generator;

    protected $distribution;

    function __construct(Generator $generator, StreamsDistribution $distribution)
    {
        $this->generator    = $generator;
        $this->distribution = $distribution;
    }

    public function handle()
    {
        $template = $this->distribution->getPath('resources/assets/generator/distribution.txt');

        $file = base_path('config/distribution.php');

        @unlink($file);

        $this->generator->make($template, [], $file);
    }
}
 