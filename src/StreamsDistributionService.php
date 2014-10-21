<?php namespace Streams\Addon\Distribution\Streams;

use Illuminate\Http\Request;
use Streams\Addon\Distribution\Streams\Command\GenerateDatabaseFileCommand;
use Streams\Platform\Traits\CommandableTrait;
use Streams\Addon\Distribution\Streams\Command\InstallDatabaseCommand;
use Streams\Addon\Distribution\Streams\Command\GenerateConfigFileCommand;

class StreamsDistributionService
{
    use CommandableTrait;

    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function install()
    {
        $this->generateConfigFile();
        $this->generateDatabaseFile();

        $this->installDatabase();
        $this->installModules();

        $this->installAdministrator();

        return true;
    }

    private function generateConfigFile()
    {
        $locale   = 'en';
        $timezone = 'UTC';
        $key      = rand_string(30);

        $command = new GenerateConfigFileCommand($key, $locale, $timezone);

        $this->execute($command);
    }

    protected function generateDatabaseFile()
    {
        $input = $this->request->get('database');

        $host     = $input['host'];
        $user     = $input['user'];
        $driver   = $input['driver'];
        $database = $input['database'];
        $password = $input['password'];

        $command = new GenerateDatabaseFileCommand($driver, $host, $database, $user, $password);

        $this->execute($command);
    }

    protected function installDatabase()
    {
        $command = new InstallDatabaseCommand();

        $this->execute($command);
    }

    protected function installModules()
    {
        /*$command = new InstallModulesCommand();

        $this->execute($command);*/
    }

    protected function installAdministrator()
    {
        /*$input = $this->request->get('administrator');

        $email    = $input['email'];
        $username = $input['username'];
        $password = $input['password'];

        $command = new InstallAdministratorCommand($username, $email, $password);

        $this->execute($command);*/
    }
}
 