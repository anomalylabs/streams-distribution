<?php namespace Anomaly\StreamsDistribution\Command\Handler;

use Illuminate\Foundation\Console\Kernel;

/**
 * Class RunMigrationsHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Command\Handler
 */
class RunMigrationsHandler
{

    /**
     * The command kernel.
     *
     * @var Kernel
     */
    protected $command;

    /**
     * Create a new RunMigrationsHandler instance.
     *
     * @param Kernel $command
     */
    function __construct(Kernel $command)
    {
        $this->command = $command;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $this->command->call('migrate', ['--no-addons']);
    }
}
