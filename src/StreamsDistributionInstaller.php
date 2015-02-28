<?php namespace Anomaly\StreamsDistribution;

use Anomaly\Streams\Platform\Addon\Extension\Command\InstallAllExtensions;
use Anomaly\Streams\Platform\Addon\Module\Command\InstallAllModules;
use Anomaly\Streams\Platform\Application\Command\GenerateEnvironmentFile;
use Anomaly\Streams\Platform\Entry\Command\AutoloadEntryModels;
use Anomaly\Streams\Platform\Stream\Command\CreateStreamsTables;
use Anomaly\StreamsDistribution\Command\GetEnvironmentVariables;
use Anomaly\StreamsDistribution\Command\RunMigrations;
use Anomaly\StreamsDistribution\Command\SetupApplication;
use Anomaly\UsersModule\Role\RoleManager;
use Anomaly\UsersModule\User\UserManager;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class StreamsDistributionInstaller
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution
 */
class StreamsDistributionInstaller
{

    use DispatchesCommands;

    /**
     * The role manager.
     *
     * @var RoleManager
     */
    protected $roles;

    /**
     * The user manager.
     *
     * @var UserManager
     */
    protected $users;

    /**
     * Create a new StreamsDistributionInstaller instance.
     *
     * @param RoleManager $roles
     * @param UserManager $users
     */
    function __construct(RoleManager $roles, UserManager $users)
    {
        $this->roles = $roles;
        $this->users = $users;
    }

    /**
     * Install the system.
     *
     * @param array $parameters
     * @return bool
     */
    public function install(array $parameters)
    {
        $this->dispatch(new GenerateEnvironmentFile($this->dispatch(new GetEnvironmentVariables($parameters))));

        $this->dispatch(new SetupApplication($parameters));
        $this->dispatch(new RunMigrations());
        $this->dispatch(new InstallAllModules());
        $this->dispatch(new InstallAllExtensions());
        $this->dispatch(new AutoloadEntryModels());

        $credentials = [
            'email'    => $parameters['admin_email'],
            'username' => $parameters['admin_username'],
            'password' => $parameters['admin_password']
        ];

        $user  = $this->users->create($credentials, true);
        $admin = $this->roles->create(
            [
                'en'   => [
                    'name' => 'Administrator'
                ],
                'slug' => 'admin'
            ]
        );

        $this->roles->create(
            [
                'en'   => [
                    'name' => 'User',
                ],
                'slug' => 'user'
            ]
        );

        $this->users->attachRole($user, $admin);

        return true;
    }
}
