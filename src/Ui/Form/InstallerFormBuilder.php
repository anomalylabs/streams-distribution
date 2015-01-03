<?php namespace Anomaly\StreamsDistribution\Ui\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use cebe\markdown\Markdown;

class InstallerFormBuilder extends FormBuilder
{

    protected $actions = [
        'save' => [
            'text' => 'streams::button.install',
        ]
    ];

    protected function initialize()
    {
        app('validator')->extend(
            'valid_database',
            'Anomaly\StreamsDistribution\Ui\Form\InstallerFormValidator@validateDatabase',
            'distribution.streams::field.database_driver.invalid_database'
        );

        $this->form->getOptions()->put('wrapper_view', 'distribution.streams::blank');

        $this->form->getOptions()->put(
            'handler',
            'Anomaly\StreamsDistribution\Ui\Form\InstallerFormHandler@handle'
        );

        $this->setFields(
            [
                /**
                 * License Fields
                 */
                'license'               => [
                    'label'        => 'distribution.streams::field.license.label',
                    'instructions' => 'distribution.streams::field.license.instructions',
                    'type'         => 'Anomaly\StreamsDistribution\Addon\FieldType\LicenseCheckboxesFieldType',
                    'rules'        => [
                        'required',
                    ],
                    'config'       => [
                        'agree'   => 'distribution.streams::field.license.agree',
                        'license' => function () {
                                return (new Markdown())->parse(
                                    file_get_contents(app('streams.path') . '/LICENSE')
                                );
                            }
                    ],
                ],
                /**
                 * Database Fields
                 */
                'database_driver'       => [
                    'label'        => 'distribution.streams::field.database_driver.label',
                    'instructions' => 'distribution.streams::field.database_driver.instructions',
                    'type'         => 'select',
                    'value'        => 'mysql',
                    'rules'        => [
                        'required',
                        'valid_database',
                    ],
                    'config'       => [
                        'options' => [
                            'mysql'    => 'MySQL',
                            'postgres' => 'Postgres',
                            'sqlite'   => 'SQLite',
                            'sqlsrv'   => 'SQL Server',
                        ]
                    ],
                ],
                'database_host'         => [
                    'label'        => 'distribution.streams::field.database_host.label',
                    'placeholder'  => 'distribution.streams::field.database_host.placeholder',
                    'instructions' => 'distribution.streams::field.database_host.instructions',
                    'type'         => 'text',
                    'value'        => 'localhost',
                    'rules'        => [
                        'required',
                    ],
                ],
                'database_name'         => [
                    'label'        => 'distribution.streams::field.database_name.label',
                    'placeholder'  => 'distribution.streams::field.database_name.placeholder',
                    'instructions' => 'distribution.streams::field.database_name.instructions',
                    'type'         => 'text',
                    'value'        => 'streams',
                    'rules'        => [
                        'required',
                    ],
                ],
                'database_username'     => [
                    'label'        => 'distribution.streams::field.database_username.label',
                    'placeholder'  => 'distribution.streams::field.database_username.placeholder',
                    'instructions' => 'distribution.streams::field.database_username.instructions',
                    'type'         => 'text',
                    'value'        => 'root',
                    'rules'        => [
                        'required',
                    ],
                ],
                'database_password'     => [
                    'label'        => 'distribution.streams::field.database_password.label',
                    'placeholder'  => 'distribution.streams::field.database_password.placeholder',
                    'instructions' => 'distribution.streams::field.database_password.instructions',
                    'type'         => 'text',
                    'config'       => [
                        'type' => 'password',
                    ],
                ],
                /**
                 * Administrator Fields
                 */
                'admin_username'        => [
                    'label'        => 'distribution.streams::field.admin_username.label',
                    'placeholder'  => 'distribution.streams::field.admin_username.placeholder',
                    'instructions' => 'distribution.streams::field.admin_username.instructions',
                    'type'         => 'text',
                    'value'        => 'admin',
                    'rules'        => [
                        'required',
                    ],
                ],
                'admin_email'           => [
                    'label'        => 'distribution.streams::field.admin_email.label',
                    'placeholder'  => 'distribution.streams::field.admin_email.placeholder',
                    'instructions' => 'distribution.streams::field.admin_email.instructions',
                    'type'         => 'email',
                    'rules'        => [
                        'required',
                    ],
                ],
                'admin_password'        => [
                    'label'        => 'distribution.streams::field.admin_password.label',
                    'placeholder'  => 'distribution.streams::field.admin_password.placeholder',
                    'instructions' => 'distribution.streams::field.admin_password.instructions',
                    'type'         => 'text',
                    'rules'        => [
                        'required',
                    ],
                    'config'       => [
                        'type' => 'password',
                    ],
                ],
                /**
                 * Application Fields
                 */
                'application_name'      => [
                    'label'        => 'distribution.streams::field.application_name.label',
                    'placeholder'  => 'distribution.streams::field.application_name.placeholder',
                    'instructions' => 'distribution.streams::field.application_name.instructions',
                    'type'         => 'text',
                    'value'        => 'Default',
                    'rules'        => [
                        'required',
                    ],
                ],
                'application_reference' => [
                    'label'        => 'distribution.streams::field.application_reference.label',
                    'placeholder'  => 'distribution.streams::field.application_reference.placeholder',
                    'instructions' => 'distribution.streams::field.application_reference.instructions',
                    'type'         => 'slug',
                    'value'        => 'default',
                    'rules'        => [
                        'required',
                    ],
                ],
                'application_domain'    => [
                    'label'        => 'distribution.streams::field.application_domain.label',
                    'placeholder'  => 'distribution.streams::field.application_domain.placeholder',
                    'instructions' => 'distribution.streams::field.application_domain.instructions',
                    'type'         => 'text',
                    'value'        => str_replace(['http://', 'https://'], '', app('request')->root()),
                    'rules'        => [
                        'required',
                    ],
                ],
                'application_locale'    => [
                    'label'        => 'distribution.streams::field.application_locale.label',
                    'instructions' => 'distribution.streams::field.application_locale.instructions',
                    'type'         => 'select',
                    'value'        => 'en',
                    'rules'        => [
                        'required',
                    ],
                    'config'       => [
                        'options' => function () {

                                $options = [];

                                foreach (config('streams::config.available_locales') as $locale) {

                                    $options[$locale] = trans('streams::language.' . $locale);
                                }

                                return $options;
                            }
                    ],
                ],
                'application_timezone'  => [
                    'label'        => 'distribution.streams::field.application_timezone.label',
                    'instructions' => 'distribution.streams::field.application_timezone.instructions',
                    'type'         => 'select',
                    'value'        => 'UTC',
                    'rules'        => [
                        'required',
                    ],
                    'config'       => [
                        'options' => function () {

                                $options = [];

                                foreach (timezone_identifiers_list() as $timezone) {

                                    $options[$timezone] = $timezone;
                                }

                                return $options;
                            }
                    ],
                ],
            ]
        );
    }
}
 
