<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Addon\Distribution\Streams\StreamsDistributionService;

class InstallController extends PublicController
{
    /**
     * Install the system.
     *
     * @param StreamsDistributionService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function install(StreamsDistributionService $service)
    {
        if ($service->install()) {

            return redirect('installer/complete');

        }
    }

    /**
     * Show the welcome page.
     *
     * @return mixed
     */
    public function complete()
    {
        return view('distribution::complete');
    }
}