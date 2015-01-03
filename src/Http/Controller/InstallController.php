<?php namespace Anomaly\StreamsDistribution\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\StreamsDistribution\StreamsDistributionInstaller;

class InstallController extends PublicController
{
    /**
     * Install the system.
     *
     * @param StreamsDistributionInstaller $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function install(StreamsDistributionInstaller $service)
    {
        if ($service->install()) {

            return redirect('/');

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