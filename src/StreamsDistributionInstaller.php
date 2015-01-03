<?php namespace Anomaly\StreamsDistribution;

use Anomaly\UsersModule\Role\RoleManager;
use Anomaly\UsersModule\User\UserManager;
use Laracasts\Commander\CommanderTrait;

class StreamsDistributionInstaller
{

    use CommanderTrait;

    public function install(array $parameters)
    {
        $this->generateDistributionFile();
        $this->generateConfigFile($parameters);
        $this->generateDatabaseFile($parameters);

        $this->installApplicationTables($parameters);
        $this->installRevisionsTables();
        $this->installStreamsTables();
        $this->installModulesTable();

        $this->syncModules();
        $this->installAllModules();

        $this->installAdministrator($parameters);

        return true;
    }

    protected function generateDistributionFile()
    {
        $this->execute('Anomaly\StreamsDistribution\Command\GenerateDistributionFileCommand');
    }

    private function generateConfigFile(array $parameters)
    {
        $data = [
            'locale'   => $parameters['application_locale'],
            'timezone' => $parameters['application_timezone'],
            'key'      => app('Illuminate\Support\Str')->random(32)
        ];

        $this->execute('Anomaly\StreamsDistribution\Command\GenerateConfigFileCommand', $data);
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

        $this->execute('Anomaly\StreamsDistribution\Command\GenerateDatabaseFileCommand', $data);
    }

    protected function installApplicationTables(array $parameters)
    {
        $data = [
            'name'      => $parameters['application_name'],
            'domain'    => $parameters['application_domain'],
            'reference' => $parameters['application_reference'],
        ];

        $this->execute('Anomaly\Streams\Platform\Application\Command\InstallApplicationTablesCommand', $data);
    }

    protected function installRevisionsTables()
    {
        $this->execute('Anomaly\Streams\Platform\Application\Command\InstallRevisionsTablesCommand');
    }

    protected function installStreamsTables()
    {
        $this->execute('Anomaly\Streams\Platform\Stream\Command\InstallStreamsTablesCommand');
    }

    protected function installModulesTable()
    {
        $this->execute('Anomaly\Streams\Platform\Addon\Module\Command\InstallModulesTableCommand');
    }

    protected function syncModules()
    {
        $this->execute('Anomaly\Streams\Platform\Addon\Module\Command\SyncModulesCommand');
    }

    protected function installAllModules()
    {
        $this->execute('Anomaly\Streams\Platform\Addon\Module\Command\InstallAllModulesCommand');
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

        $user = $users->create($credentials, true);

        $adminRole = $roles->create(['name' => 'Administrator', 'slug' => 'admin']);
        $userRole  = $roles->create(['name' => 'User', 'slug' => 'user']);
    }
}
 
