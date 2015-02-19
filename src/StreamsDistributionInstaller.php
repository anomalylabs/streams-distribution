<?php namespace Anomaly\StreamsDistribution;

use Anomaly\Streams\Platform\Addon\Extension\Command\InstallAllExtensions;
use Anomaly\Streams\Platform\Addon\Extension\Command\InstallExtensionsTable;
use Anomaly\Streams\Platform\Addon\Extension\Command\SyncExtensions;
use Anomaly\Streams\Platform\Addon\Module\Command\InstallAllModules;
use Anomaly\Streams\Platform\Addon\Module\Command\InstallModulesTable;
use Anomaly\Streams\Platform\Addon\Module\Command\SyncModules;
use Anomaly\Streams\Platform\Application\Command\GenerateEnvironmentFile;
use Anomaly\Streams\Platform\Stream\Command\InstallStreamsTables;
use Anomaly\StreamsDistribution\Command\CreateFailedJobsTable;
use Anomaly\StreamsDistribution\Command\GenerateDistributionFile;
use Anomaly\UsersModule\Role\RoleManager;
use Anomaly\UsersModule\User\UserManager;
use Illuminate\Foundation\Bus\DispatchesCommands;

class StreamsDistributionInstaller
{

    use DispatchesCommands;

    protected $roles;

    protected $users;

    function __construct(RoleManager $roles, UserManager $users)
    {
        $this->roles = $roles;
        $this->users = $users;
    }

    public function install(array $parameters)
    {
        $this->generateEnvironmentFile($parameters);

        $this->installApplicationTables($parameters);
        $this->installFailedJobsTable();
        $this->installExtensionsTable();
        $this->installStreamsTables();
        $this->installModulesTable();
        $this->syncModules();
        $this->syncExtensions();
        $this->installAllModules();
        $this->installAllExtensions();

        $this->installAdministrator($parameters);

        return true;
    }

    /**
     * @param array $parameters
     */
    protected function generateEnvironmentFile(array $parameters)
    {
        $distribution = $this->distributions->active();

        $variables = [
            'APP_KEY'        => app('Illuminate\Support\Str')->random(32),
            'DB_DRIVER'      => $parameters['database_driver'],
            'DB_HOST'        => $parameters['database_host'],
            'DB_DATABASE'    => $parameters['database_name'],
            'DB_USERNAME'    => $parameters['database_username'],
            'DB_PASSWORD'    => $parameters['database_password'],
            'CACHE_DRIVER'   => 'file', // @todo - add fields for this?
            'SESSION_DRIVER' => 'file', // @todo - add fields for this?
            'ADMIN_THEME'    => $distribution->getAdminTheme(),
            'STANDARD_THEME' => $distribution->getStandardTheme(),
            'LOCALE'         => $parameters['application_locale'],
            'TIMEZONE'       => $parameters['application_timezone'],
        ];

        $this->dispatch(new GenerateEnvironmentFile($variables));
    }

    protected function installApplicationTables(array $parameters)
    {
        $data = [
            'name'      => $parameters['application_name'],
            'domain'    => $parameters['application_domain'],
            'reference' => $parameters['application_reference'],
        ];

        $this->dispatchFromArray('Anomaly\StreamsDistribution\Command\CreateApplicationTables', $data);
    }

    protected function installFailedJobsTable()
    {
        $this->dispatch(new CreateFailedJobsTable());
    }

    protected function installStreamsTables()
    {
        $this->dispatch(new InstallStreamsTables());
    }

    protected function installModulesTable()
    {
        $this->dispatch(new InstallModulesTable());
    }

    protected function installExtensionsTable()
    {
        $this->dispatch(new InstallExtensionsTable());
    }

    protected function syncModules()
    {
        $this->dispatch(new SyncModules());
    }

    protected function installAllModules()
    {
        $this->dispatch(new InstallAllModules());
    }

    protected function syncExtensions()
    {
        $this->dispatch(new SyncExtensions());
    }

    protected function installAllExtensions()
    {
        $this->dispatch(new InstallAllExtensions());
    }

    protected function installAdministrator(array $parameters)
    {
        $credentials = [
            'email'    => $parameters['admin_email'],
            'username' => $parameters['admin_username'],
            'password' => $parameters['admin_password']
        ];

        $user = $this->users->create($credentials, true);
        $admin = $this->roles->create(
            [
                'name' => 'Administrator',
                'slug' => 'admin'
            ]
        );

        $this->roles->create(['name' => 'User', 'slug' => 'user']);

        $this->users->attachRole($user, $admin);
    }
}
 
