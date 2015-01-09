<?php namespace Anomaly\StreamsDistribution;

use Anomaly\Streams\Platform\Addon\Module\Command\InstallAllModulesCommand;
use Anomaly\Streams\Platform\Addon\Module\Command\InstallModulesTableCommand;
use Anomaly\Streams\Platform\Addon\Module\Command\SyncModulesCommand;
use Anomaly\Streams\Platform\Application\Command\CreateFailedJobsTableCommand;
use Anomaly\Streams\Platform\Application\Command\CreateRevisionsTableCommand;
use Anomaly\Streams\Platform\Stream\Command\InstallStreamsTablesCommand;
use Anomaly\StreamsDistribution\Command\GenerateDistributionFileCommand;
use Anomaly\UsersModule\Role\RoleManager;
use Anomaly\UsersModule\User\UserManager;
use Illuminate\Foundation\Bus\DispatchesCommands;

class StreamsDistributionInstaller
{

    use DispatchesCommands;

    public function install(array $parameters)
    {
        $this->generateDistributionFile();
        $this->generateConfigFile($parameters);
        $this->generateDatabaseFile($parameters);

        $this->installApplicationTables($parameters);
        $this->installFailedJobsTable();
        $this->installRevisionsTable();
        $this->installStreamsTables();
        $this->installModulesTable();

        $this->syncModules();
        $this->installAllModules();

        $this->installAdministrator($parameters);

        return true;
    }

    protected function generateDistributionFile()
    {
        $this->dispatch(new GenerateDistributionFileCommand());
    }

    private function generateConfigFile(array $parameters)
    {
        $data = [
            'locale'   => $parameters['application_locale'],
            'timezone' => $parameters['application_timezone'],
            'key'      => app('Illuminate\Support\Str')->random(32)
        ];

        $this->dispatchFromArray('Anomaly\StreamsDistribution\Command\GenerateConfigFileCommand', $data);
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

        $this->dispatchFromArray('Anomaly\StreamsDistribution\Command\GenerateDatabaseFileCommand', $data);
    }

    protected function installApplicationTables(array $parameters)
    {
        $data = [
            'name'      => $parameters['application_name'],
            'domain'    => $parameters['application_domain'],
            'reference' => $parameters['application_reference'],
        ];

        $this->dispatchFromArray('Anomaly\Streams\Platform\Application\Command\CreateApplicationTablesCommand', $data);
    }

    protected function installRevisionsTable()
    {
        $this->dispatch(new CreateRevisionsTableCommand());
    }

    protected function installFailedJobsTable()
    {
        $this->dispatch(new CreateFailedJobsTableCommand());
    }

    protected function installStreamsTables()
    {
        $this->dispatch(new InstallStreamsTablesCommand());
    }

    protected function installModulesTable()
    {
        $this->dispatch(new InstallModulesTableCommand());
    }

    protected function syncModules()
    {
        $this->dispatch(new SyncModulesCommand());
    }

    protected function installAllModules()
    {
        $this->dispatch(new InstallAllModulesCommand());
    }

    protected function installAdministrator(array $parameters)
    {
        $credentials = [
            'email'    => $parameters['admin_email'],
            'username' => $parameters['admin_username'],
            'password' => $parameters['admin_password']
        ];

        $users = new UserManager();
        $roles = new RoleManager();

        $user = $users->create($credentials);

        $adminRole = $roles->create(['name' => 'Administrator', 'slug' => 'admin']);
        $userRole  = $roles->create(['name' => 'User', 'slug' => 'user']);
    }
}
 
