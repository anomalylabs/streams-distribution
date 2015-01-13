<?php namespace Anomaly\StreamsDistribution\Ui\Form;

class InstallerFormValidator
{

    public function validateDatabase()
    {
        $input = app('request')->all();

        app('config')->set(
            'database.connections.install',
            [
                'driver'    => $input['form_database_driver'],
                'host'      => $input['form_database_host'],
                'database'  => $input['form_database_name'],
                'username'  => $input['form_database_username'],
                'password'  => $input['form_database_password'],
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
            ]
        );

        try {

            app('db')->connection('install');
        } catch (\Exception $e) {

            $error = $e->getMessage();

            app('session')->flash(
                'warning',
                [trans('distribution::message.database_error', compact('error'))]
            );

            return false;
        }

        return true;
    }
}
