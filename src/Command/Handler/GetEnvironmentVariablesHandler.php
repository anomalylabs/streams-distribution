<?php namespace Anomaly\StreamsDistribution\Command\Handler;


use Anomaly\Streams\Platform\Addon\Distribution\DistributionCollection;
use Anomaly\StreamsDistribution\Command\GetEnvironmentVariables;

class GetEnvironmentVariablesHandler
{

    /**
     * @var DistributionCollection
     */
    protected $distributions;

    /**
     * @param DistributionCollection $distributions
     */
    public function __construct(DistributionCollection $distributions)
    {
        $this->distributions = $distributions;
    }

    /**
     * @param GetEnvironmentVariables $command
     *
     * @return array
     */
    public function handle(GetEnvironmentVariables $command)
    {
        $parameters = $command->getParameters();

        $distribution = $this->distributions->active();

        $variables = [
            'INSTALLED'         => 'true',
            'APP_DEBUG'         => 'false',
            'APP_KEY'           => str_random(32),
            'DB_DRIVER'         => $parameters['database_driver'],
            'DB_HOST'           => $parameters['database_host'],
            'DB_DATABASE'       => $parameters['database_name'],
            'DB_USERNAME'       => $parameters['database_username'],
            'DB_PASSWORD'       => $parameters['database_password'],
            'CACHE_DRIVER'      => 'file', // @todo - add fields for this?
            'SESSION_DRIVER'    => 'file', // @todo - add fields for this?
            'ADMIN_THEME'       => $distribution->getAdminTheme(),
            'STANDARD_THEME'    => $distribution->getStandardTheme(),
            'LOCALE'            => $parameters['application_locale'],
            'TIMEZONE'          => $parameters['application_timezone'],
            'MAIL_DRIVER'       => 'smtp',
            'MAIL_HOST'         => 'smtp.mailgun.org',
            'SMTP_PORT'         => 587,
            'MAIL_FROM_ADDRESS' => null,
            'MAIL_FROM_NAME'    => null,
            'SMTP_USERNAME'     => null,
            'SMTP_PASSWORD'     => null,
            'MAIL_DEBUG'        => false
        ];

        $this->setDatabaseConfig($variables);

        return $variables;
    }

    /**
     * @param array $variables
     */
    protected function setDatabaseConfig(array $variables)
    {
        config()->set(
            "database.connections.{$variables['DB_DRIVER']}",
            [
                'driver'    => $variables['DB_DRIVER'],
                'host'      => $variables['DB_HOST'],
                'database'  => $variables['DB_DATABASE'],
                'username'  => $variables['DB_USERNAME'],
                'password'  => $variables['DB_PASSWORD'],
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
                'strict'    => false,
            ]
        );

        config()->set(
            "database.connections.core",
            [
                'driver'    => $variables['DB_DRIVER'],
                'host'      => $variables['DB_HOST'],
                'database'  => $variables['DB_DATABASE'],
                'username'  => $variables['DB_USERNAME'],
                'password'  => $variables['DB_PASSWORD'],
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
                'strict'    => false,
            ]
        );
    }
}