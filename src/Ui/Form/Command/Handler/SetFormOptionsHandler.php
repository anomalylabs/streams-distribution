<?php namespace Anomaly\StreamsDistribution\Ui\Form\Command\Handler;

use Anomaly\StreamsDistribution\Ui\Form\Command\SetFormOptions;

/**
 * Class SetFormOptionsHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Ui\Form\Command
 */
class SetFormOptionsHandler
{

    /**
     * Handle the command.
     *
     * @param SetFormOptions $command
     */
    public function handle(SetFormOptions $command)
    {
        $options = $command->getOptions();

        $options->put('wrapper_view', 'anomaly.distribution.streams::blank');
        $options->put('handler', 'Anomaly\StreamsDistribution\Ui\Form\InstallerFormHandler@handle');

        $options->put(
            'sections',
            [
                [
                    'fields' => [
                        'license',
                    ]
                ],
                [
                    'title'  => 'anomaly.distribution.streams::installer.database',
                    'fields' => [
                        'database_driver',
                        'database_host',
                        'database_name',
                        'database_username',
                        'database_password',
                    ]
                ],
                [
                    'title'  => 'anomaly.distribution.streams::installer.administrator',
                    'fields' => [
                        'admin_username',
                        'admin_email',
                        'admin_password',
                    ]
                ],
                [
                    'title'  => 'anomaly.distribution.streams::installer.application',
                    'fields' => [
                        'application_name',
                        'application_reference',
                        'application_domain',
                        'application_locale',
                        'application_timezone',
                    ]
                ]
            ]
        );
    }
}
