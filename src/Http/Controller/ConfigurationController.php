<?php namespace Anomaly\Streams\Distribution\Streams\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;

class ConfigurationController extends PublicController
{
    /**
     * Setup database options.
     *
     * @return mixed
     */
    public function index()
    {
        return view('distribution.base::configuration');
    }
}