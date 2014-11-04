<?php namespace Anomaly\Streams\Addon\Distribution\Streams;

use Anomaly\Streams\Platform\Addon\Distribution\Distribution;

class StreamsDistribution extends Distribution
{
    public function getAdminTheme()
    {
        return app('streams.theme.streams');
    }

    public function getPublicTheme()
    {
        return app('streams.theme.streams');
    }

    public function newServiceProvider()
    {
        return new StreamsDistributionServiceProvider($this->app);
    }
}
