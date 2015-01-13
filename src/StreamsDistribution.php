<?php namespace Anomaly\StreamsDistribution;

use Anomaly\Streams\Platform\Addon\Distribution\Distribution;

/**
 * Class StreamsDistribution
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution
 */
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
