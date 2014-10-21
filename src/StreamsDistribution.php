<?php namespace Anomaly\Streams\Addon\Distribution\Streams;

use Anomaly\Streams\Platform\Addon\Distribution\DistributionAddon;

class StreamsDistribution extends DistributionAddon
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
