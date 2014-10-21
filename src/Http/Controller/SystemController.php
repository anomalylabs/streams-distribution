<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;

class SystemController extends PublicController
{
    /**
     * Check the system for compatibility.
     *
     * @return mixed
     */
    public function index()
    {
        $ready = true;

        $checks = [
            [
                'key'    => 'php',
                'result' => version_compare(PHP_VERSION, "5.4", ">="),
            ],
            [
                'key'    => 'curl',
                'result' => function_exists('curl_version'),
            ],
            [
                'key'    => 'pdo',
                'result' => defined('PDO::ATTR_DRIVER_NAME'),
            ],
            [
                'key'    => 'mcrypt',
                'result' => extension_loaded('mcrypt'),
            ],
            [
                'key'    => 'zip',
                'result' => extension_loaded('zip'),
            ],
            [
                'key'    => 'gd',
                'result' => extension_loaded('gd'),
            ],
            [
                'key'    => 'fileinfo',
                'result' => extension_loaded('fileinfo'),
            ],
        ];

        foreach ($checks as &$check) {
            $check['class']   = $check['result'] ? 'panel-success' : 'panel-danger';
            $check['message'] = trans('distribution::message.' . $check['key']);

            if (!$check['result']) {
                $ready = false;
            }
        }

        return view('distribution::system', compact('checks', 'ready'));
    }
}