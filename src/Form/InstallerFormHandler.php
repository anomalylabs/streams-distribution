<?php namespace Anomaly\StreamsDistribution\Form;

use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\StreamsDistribution\StreamsDistributionInstaller;

/**
 * Class InstallerFormHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Form
 */
class InstallerFormHandler
{

    /**
     * Handle the installer form.
     *
     * @param Form                         $form
     * @param StreamsDistributionInstaller $distributionInstaller
     */
    public function handle(Form $form, StreamsDistributionInstaller $distributionInstaller)
    {
        $distributionInstaller->install($_POST);

        $form->setResponse(redirect('installer/complete'));
    }
}
 