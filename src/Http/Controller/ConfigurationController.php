<?php namespace Anomaly\Streams\Distribution\Base\Http\Controller;

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