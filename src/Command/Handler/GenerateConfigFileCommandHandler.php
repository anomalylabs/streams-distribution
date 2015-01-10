<?php namespace Anomaly\StreamsDistribution\Command\Handler;

use Anomaly\StreamsDistribution\Command\GenerateConfigFileCommand;

class GenerateConfigFileCommandHandler
{

    public function handle(GenerateConfigFileCommand $command)
    {
        $key      = $command->getKey();
        $locale   = $command->getLocale();
        $timezone = $command->getTimezone();

        $data = compact('key', 'locale', 'timezone');

        $template = file_get_contents(app('streams.path') . '/resources/assets/generator/config.twig');

        $file = base_path('config/app.php');

        @unlink($file);

        file_put_contents($file, app('twig.string')->render($template, $data));
    }
}
 