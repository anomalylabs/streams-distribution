<?php namespace Anomaly\StreamsDistribution;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class StreamsDistributionServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution
 */
class StreamsDistributionServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'installer'          => 'Anomaly\StreamsDistribution\Http\Controller\InstallerController@index',
        'installer/complete' => 'Anomaly\StreamsDistribution\Http\Controller\InstallerController@complete'
    ];

}
