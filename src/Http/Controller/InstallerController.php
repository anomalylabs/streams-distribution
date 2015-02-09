<?php namespace Anomaly\StreamsDistribution\Http\Controller;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\StreamsDistribution\Form\InstallerFormBuilder;

/**
 * Class InstallerController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Http\Controller
 */
class InstallerController extends PublicController
{

    /**
     * Create a new InstallerController instance.
     *
     * @param InstallerFormBuilder $form
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(InstallerFormBuilder $form, Application $application)
    {
        if ($application->isInstalled()) {
            throw new \Exception("Please delete the config/distribution.php file before installing.");
        }

        return $form->render();
    }

    /**
     * Show the complete page.
     *
     * @return \Illuminate\View\View
     */
    public function complete()
    {
        return view('anomaly.distribution.streams::complete');
    }
}
 