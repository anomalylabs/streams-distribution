<?php namespace Anomaly\Streams\Distribution\Base;

use Anomaly\Streams\Platform\Addon\Distribution\DistributionAddon;

class BaseDistribution extends DistributionAddon
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
        return new BaseDistributionServiceProvider($this->app);
    }
}
