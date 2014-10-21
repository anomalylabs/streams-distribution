<?php namespace Streams\Addon\Distribution\Streams\Http\Controller;

use Streams\Platform\Http\Controller\PublicController;

class ConfigurationController extends PublicController
{
    /**
     * Setup database options.
     *
     * @return mixed
     */
    public function index()
    {
        return view('distribution::configuration');
    }
}