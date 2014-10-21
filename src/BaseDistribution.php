<?php namespace Streams\Addon\Distribution\Streams;

use Streams\Platform\Addon\Distribution\DistributionAddon;

class StreamsDistribution extends DistributionAddon
{
    protected $slug = 'streams';

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
