<?php namespace Anomaly\StreamsDistribution\Command\Handler;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\StreamsDistribution\Command\SetupApplication;

/**
 * Class SetupApplicationHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Command\Handler
 */
class SetupApplicationHandler
{

    /**
     * The streams application.
     *
     * @var Application
     */
    protected $application;

    /**
     * Create a new SetupApplicationHandler instance.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Handle the command.
     *
     * @param SetupApplication $command
     */
    public function handle(SetupApplication $command)
    {
        $reference = array_get($command->getParameters(), 'application_reference');

        /**
         * Set the reference manually since we
         * can not locate it quite yet.
         */
        $this->application->setReference($reference);

        // Setup the application.
        $this->application->setup($reference);
    }
}
