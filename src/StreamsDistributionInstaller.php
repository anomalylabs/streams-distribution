<?php namespace Anomaly\StreamsDistribution;

use Anomaly\Streams\Platform\Addon\Extension\Command\InstallAllExtensions;
use Anomaly\Streams\Platform\Addon\Extension\Command\InstallExtensionsTable;
use Anomaly\Streams\Platform\Addon\Extension\Command\SyncExtensions;
use Anomaly\Streams\Platform\Addon\Module\Command\InstallAllModules;
use Anomaly\Streams\Platform\Addon\Module\Command\InstallModulesTable;
use Anomaly\Streams\Platform\Addon\Module\Command\SyncModules;
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
        $this->generateDistributionFile();
        $this->generateConfigFile($parameters);
        $this->generateDatabaseFile($parameters);

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

    protected function generateDistributionFile()
    {
        $this->dispatch(new GenerateDistributionFile());
    }

    private function generateConfigFile(array $parameters)
    {
        $data = [
            'locale'   => $parameters['application_locale'],
            'timezone' => $parameters['application_timezone'],
            'key'      => app('Illuminate\Support\Str')->random(32)
        ];

        $this->dispatchFromArray('Anomaly\StreamsDistribution\Command\GenerateConfigFile', $data);
    }

    protected function generateDatabaseFile(array $parameters)
    {
        $data = [
            'host'     => $parameters['database_host'],
            'database' => $parameters['database_name'],
            'driver'   => $parameters['database_driver'],
            'username' => $parameters['database_username'],
            'password' => $parameters['database_password'],
        ];

        $this->dispatchFromArray('Anomaly\StreamsDistribution\Command\GenerateDatabaseFile', $data);
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

        $user  = $this->users->create($credentials, true);
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
 
