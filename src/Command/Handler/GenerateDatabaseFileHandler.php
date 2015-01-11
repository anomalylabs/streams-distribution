<?php namespace Anomaly\StreamsDistribution\Command\Handler;

use Anomaly\StreamsDistribution\Command\GenerateDatabaseFile;

class GenerateDatabaseFileHandler
{

    public function handle(GenerateDatabaseFile $command)
    {
        $driver = $command->getDriver();

        $connection = $this->compileConnection($command);

        $data = compact('driver', 'connection');

        $template = file_get_contents(app('streams.path') . '/resources/assets/generator/database.twig');

        $file = base_path('config/database.php');

        @unlink($file);

        file_put_contents($file, app('twig.string')->render($template, $data));

        $this->setDatabaseConfig();
    }

    protected function compileConnection(GenerateDatabaseFile $command)
    {
        $host     = $command->getHost();
        $driver   = $command->getDriver();
        $username = $command->getUsername();
        $database = $command->getDatabase();
        $password = $command->getPassword();

        $template = file_get_contents(
            app('streams.path') . '/resources/assets/generator/connections/' . $driver . '.twig'
        );

        $data = compact('host', 'driver', 'username', 'database', 'password');

        return app('twig.string')->render($template, $data);
    }

    protected function setDatabaseConfig()
    {
        $files = app('files');

        $database = $files->getRequire(base_path('config/database.php'));

        app('config')->set('database', $database);
    }
}
