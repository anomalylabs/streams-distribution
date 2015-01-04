<?php namespace Anomaly\StreamsDistribution\Command;

use Anomaly\Streams\Platform\Addon\Distribution\DistributionCollection;
use Way\Generators\Generator;

class GenerateDistributionFileCommandHandler
{

    protected $generator;

    protected $distributions;

    function __construct(Generator $generator, DistributionCollection $distributions)
    {
        $this->generator     = $generator;
        $this->distributions = $distributions;
    }

    public function handle()
    {
        $template = app('streams.path') . '/resources/assets/generator/distribution.txt';

        $file = base_path('config/distribution.php');

        @unlink($file);

        $distribution = $this->distributions->active();

        $admin    = $distribution->getAdminTheme();
        $standard = $distribution->getStandardTheme();

        $this->generator->make($template, compact('admin', 'standard'), $file);
    }
}
 