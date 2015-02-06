<?php namespace Anomaly\StreamsDistribution\Ui\Form;

class InstallerFormValidator
{

    public function validateDatabase()
    {
        $input = app('request')->all();

        app('config')->set(
            'database.connections.install',
            [
                'driver'    => $input['database_driver_en'],
                'host'      => $input['database_host_en'],
                'database'  => $input['database_name_en'],
                'username'  => $input['database_username_en'],
                'password'  => $input['database_password_en'],
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
