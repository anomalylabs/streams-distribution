<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Ui\Form;

use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use cebe\markdown\Markdown;

class InstallerFormBuilder extends FormBuilder
{

    protected $handler = 'Anomaly\Streams\Addon\Distribution\Streams\Ui\Form\InstallerFormHandler@handle';

    protected $actions = [
        'save' => [
            'text' => 'button.install',
        ]
    ];

    function __construct(Form $form)
    {
        app('validator')->extend(
            'valid_database',
            'Anomaly\Streams\Addon\Distribution\Streams\Ui\Form\InstallerFormValidator@validateDatabase',
            'distribution.streams::field.database_driver.invalid_database'
        );

        $form->setWrapper('distribution.streams::blank');

        $this->setSections(
            [
                [
                    'fields' => [
                        [
                            'label'        => 'distribution.streams::field.license.label',
                            'instructions' => 'distribution.streams::field.license.instructions',
                            'slug'         => 'license',
                            'type'         => 'Anomaly\Streams\Addon\Distribution\Streams\Addon\FieldType\LicenseCheckboxesFieldType',
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
                    ],
                ],
                [
                    'title'  => 'distribution.streams::admin.database',
                    'fields' => [
                        [
                            'label'        => 'distribution.streams::field.database_driver.label',
                            'instructions' => 'distribution.streams::field.database_driver.instructions',
                            'slug'         => 'database_driver',
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
                        [
                            'label'        => 'distribution.streams::field.database_host.label',
                            'placeholder'  => 'distribution.streams::field.database_host.placeholder',
                            'instructions' => 'distribution.streams::field.database_host.instructions',
                            'slug'         => 'database_host',
                            'type'         => 'text',
                            'value'        => 'localhost',
                            'rules'        => [
                                'required',
                            ],
                        ],
                        [
                            'label'        => 'distribution.streams::field.database_name.label',
                            'placeholder'  => 'distribution.streams::field.database_name.placeholder',
                            'instructions' => 'distribution.streams::field.database_name.instructions',
                            'slug'         => 'database_name',
                            'type'         => 'text',
                            'value'        => 'streams',
                            'rules'        => [
                                'required',
                            ],
                        ],
                        [
                            'label'        => 'distribution.streams::field.database_username.label',
                            'placeholder'  => 'distribution.streams::field.database_username.placeholder',
                            'instructions' => 'distribution.streams::field.database_username.instructions',
                            'slug'         => 'database_username',
                            'type'         => 'text',
                            'value'        => 'root',
                            'rules'        => [
                                'required',
                            ],
                        ],
                        [
                            'label'        => 'distribution.streams::field.database_password.label',
                            'placeholder'  => 'distribution.streams::field.database_password.placeholder',
                            'instructions' => 'distribution.streams::field.database_password.instructions',
                            'slug'         => 'database_password',
                            'type'         => 'text',
                            'config'       => [
                                'type' => 'password',
                            ],
                        ],
                    ]
                ],
                [
                    'title'  => 'distribution.streams::admin.administrator',
                    'fields' => [
                        [
                            'label'        => 'distribution.streams::field.admin_username.label',
                            'placeholder'  => 'distribution.streams::field.admin_username.placeholder',
                            'instructions' => 'distribution.streams::field.admin_username.instructions',
                            'slug'         => 'admin_username',
                            'type'         => 'text',
                            'value'        => 'admin',
                            'rules'        => [
                                'required',
                            ],
                        ],
                        [
                            'label'        => 'distribution.streams::field.admin_email.label',
                            'placeholder'  => 'distribution.streams::field.admin_email.placeholder',
                            'instructions' => 'distribution.streams::field.admin_email.instructions',
                            'slug'         => 'admin_email',
                            'type'         => 'email',
                            'rules'        => [
                                'required',
                            ],
                        ],
                        [
                            'label'        => 'distribution.streams::field.admin_password.label',
                            'placeholder'  => 'distribution.streams::field.admin_password.placeholder',
                            'instructions' => 'distribution.streams::field.admin_password.instructions',
                            'slug'         => 'admin_password',
                            'type'         => 'text',
                            'rules'        => [
                                'required',
                            ],
                            'config'       => [
                                'type' => 'password',
                            ],
                        ],
                    ]
                ],
                [
                    'title'  => 'distribution.streams::admin.application',
                    'fields' => [
                        [
                            'label'        => 'distribution.streams::field.application_name.label',
                            'placeholder'  => 'distribution.streams::field.application_name.placeholder',
                            'instructions' => 'distribution.streams::field.application_name.instructions',
                            'slug'         => 'application_name',
                            'type'         => 'text',
                            'value'        => 'Default',
                            'rules'        => [
                                'required',
                            ],
                        ],
                        [
                            'label'        => 'distribution.streams::field.application_reference.label',
                            'placeholder'  => 'distribution.streams::field.application_reference.placeholder',
                            'instructions' => 'distribution.streams::field.application_reference.instructions',
                            'slug'         => 'application_reference',
                            'type'         => 'slug',
                            'value'        => 'default',
                            'rules'        => [
                                'required',
                            ],
                        ],
                        [
                            'label'        => 'distribution.streams::field.application_domain.label',
                            'placeholder'  => 'distribution.streams::field.application_domain.placeholder',
                            'instructions' => 'distribution.streams::field.application_domain.instructions',
                            'slug'         => 'application_domain',
                            'type'         => 'text',
                            'value'        => str_replace(['http://', 'https://'], '', app('request')->root()),
                            'rules'        => [
                                'required',
                            ],
                        ],
                        [
                            'label'        => 'distribution.streams::field.application_locale.label',
                            'instructions' => 'distribution.streams::field.application_locale.instructions',
                            'slug'         => 'application_locale',
                            'type'         => 'select',
                            'value'        => 'en',
                            'rules'        => [
                                'required',
                            ],
                            'config'       => [
                                'options' => function () {

                                        $options = [];

                                        foreach (config('streams::config.available_locales') as $locale) {

                                            $options[$locale] = trans('language.' . $locale);
                                        }

                                        return $options;
                                    }
                            ],
                        ],
                        [
                            'label'        => 'distribution.streams::field.application_timezone.label',
                            'instructions' => 'distribution.streams::field.application_timezone.instructions',
                            'slug'         => 'application_timezone',
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
                ]
            ]
        );

        parent::__construct($form);
    }
}
 
