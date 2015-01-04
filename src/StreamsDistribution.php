<?php namespace Anomaly\StreamsDistribution;

use Anomaly\Streams\Platform\Addon\Distribution\Distribution;

class StreamsDistribution extends Distribution
{

    /**
     * The default standard theme.
     *
     * @var string
     */
    protected $standardTheme = 'Anomaly\StreamsTheme\StreamsTheme';

    /**
     * The default admin theme.
     *
     * @var string
     */
    protected $adminTheme = 'Anomaly\StreamsTheme\StreamsTheme';
}
