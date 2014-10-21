<?php namespace Anomaly\Streams\Distribution\Streams;

use Anomaly\Streams\Platform\Addon\Distribution\DistributionAddon;

class StreamsDistribution extends DistributionAddon
{
    protected $slug = 'base';

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