<?php namespace Anomaly\StreamsDistribution\Command\Handler;

use Anomaly\Streams\Platform\Addon\Distribution\DistributionCollection;

class GenerateDistributionFileCommandHandler
{

    protected $distributions;

    function __construct(DistributionCollection $distributions)
    {
        $this->distributions = $distributions;
    }

    public function handle()
    {
        $template = file_get_contents(app('streams.path') . '/resources/assets/generator/distribution.twig');

        $file = base_path('config/distribution.php');

        @unlink($file);

        $distribution = $this->distributions->active();

        $admin    = $distribution->getAdminTheme();
        $standard = $distribution->getStandardTheme();

        file_put_contents($file, app('twig.string')->render($template, compact('admin', 'standard')));
    }
}
 