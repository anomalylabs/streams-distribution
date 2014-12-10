<?php namespace Anomaly\Streams\Addon\Distribution\Streams;

use Anomaly\Streams\Addon\Module\Users\Role\RoleManager;
use Anomaly\Streams\Addon\Module\Users\User\UserManager;
use Laracasts\Commander\CommanderTrait;

class StreamsDistributionService
{

    use CommanderTrait;

    public function install(array $parameters)
    {
        $this->generateConfigFile($parameters);
        $this->generateDatabaseFile($parameters);

        $this->installApplicationTables($parameters);
        $this->installStreamsTables();
        $this->installModulesTable();
        $this->installRevisionsTable();

        $this->syncModules();
        $this->installModules();

        $this->installAdministrator($parameters);

        return true;
    }

    private function generateConfigFile(array $parameters)
    {
        $data = [
            'locale'   => $parameters['application_locale'],
            'timezone' => $parameters['application_timezone'],
            'key'      => rand_string(32)
        ];

        $this->execute('Anomaly\Streams\Addon\Distribution\Streams\Command\GenerateConfigFileCommand', $data);
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

        $this->execute('Anomaly\Streams\Addon\Distribution\Streams\Command\GenerateDatabaseFileCommand', $data);
    }

    protected function installApplicationTables(array $parameters)
    {
        $data = [
            'name'      => $parameters['application_name'],
            'domain'    => $parameters['application_domain'],
            'reference' => $parameters['application_reference'],
        ];

        $this->execute('Anomaly\Streams\Addon\Distribution\Streams\Command\InstallApplicationTablesCommand', $data);
    }

    protected function installStreamsTables()
    {
        $this->execute('Anomaly\Streams\Addon\Distribution\Streams\Command\InstallStreamsTablesCommand');
    }

    protected function installModulesTable()
    {
        $this->execute('Anomaly\Streams\Addon\Distribution\Streams\Command\InstallModulesTableCommand');
    }

    protected function installRevisionsTable()
    {
        $this->execute('Anomaly\Streams\Addon\Distribution\Streams\Command\InstallRevisionsTableCommand');
    }

    protected function syncModules()
    {
        $this->execute('Anomaly\Streams\Platform\Addon\Module\Command\SyncModulesCommand');
    }

    protected function installModules()
    {
        $this->execute('Anomaly\Streams\Addon\Distribution\Streams\Command\InstallModulesCommand');
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
 
