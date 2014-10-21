<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Command;

use Anomaly\Streams\Platform\Support\Generator;

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

        $template = file_get_contents(streams_path('resources/assets/generator/database.txt'));

        $path = base_path('config/database.php');

        $this->generator->make($template, $data, $path);
    }

    protected function compileConnection(GenerateDatabaseFileCommand $command)
    {
        $host     = $command->getHost();
        $driver   = $command->getDriver();
        $username = $command->getUsername();
        $database = $command->getDatabase();
        $password = $command->getPassword();

        $template = file_get_contents(streams_path('resources/assets/generator/connections/' . $driver . '.txt'));

        $data = compact('host', 'driver', 'username', 'database', 'password');

        return $this->generator->compile($template, $data);
    }
}
 