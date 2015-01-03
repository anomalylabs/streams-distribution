<?php namespace Anomaly\StreamsDistribution\Command;

use Way\Generators\Compilers\TemplateCompiler;
use Way\Generators\Generator;

class GenerateDatabaseFileCommandHandler
{

    protected $generator;

    function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function handle(GenerateDatabaseFileCommand $command)
    {
        $driver = $command->getDriver();

        $connection = $this->compileConnection($command);

        $data = compact('driver', 'connection');

        $template = app('streams.path') . '/resources/assets/generator/database.txt';

        $file = base_path('config/database.php');

        @unlink($file);

        $this->generator->make($template, $data, $file);

        $this->setDatabaseConfig();
    }

    protected function compileConnection(GenerateDatabaseFileCommand $command)
    {
        $host     = $command->getHost();
        $driver   = $command->getDriver();
        $username = $command->getUsername();
        $database = $command->getDatabase();
        $password = $command->getPassword();

        $template = app('streams.path') . '/resources/assets/generator/connections/' . $driver . '.txt';

        $data = compact('host', 'driver', 'username', 'database', 'password');

        return $this->generator->compile($template, $data, new TemplateCompiler());
    }

    protected function setDatabaseConfig()
    {
        $files = app('files');

        $database = $files->getRequire(base_path('config/database.php'));

        app('config')->set('database', $database);
    }
}
