<?php namespace Anomaly\StreamsDistribution\Ui\Form\Command;

/**
 * Class SetFormOptionsCommandHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Ui\Form\Command
 */
class SetFormOptionsCommandHandler
{

    /**
     * Handle the command.
     *
     * @param SetFormOptionsCommand $command
     */
    public function handle(SetFormOptionsCommand $command)
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
                    'title'  => 'anomaly.distribution.streams::admin.database',
                    'fields' => [
                        'database_driver',
                        'database_host',
                        'database_name',
                        'database_username',
                        'database_password',
                    ]
                ],
                [
                    'title'  => 'anomaly.distribution.streams::admin.administrator',
                    'fields' => [
                        'admin_username',
                        'admin_email',
                        'admin_password',
                    ]
                ],
                [
                    'title'  => 'anomaly.distribution.streams::admin.application',
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
