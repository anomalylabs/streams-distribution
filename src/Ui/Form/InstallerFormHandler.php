<?php namespace Anomaly\StreamsDistribution\Ui\Form;

use Anomaly\StreamsDistribution\StreamsDistributionInstaller;
use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormInput;

/**
 * Class InstallerFormHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Ui\Form
 */
class InstallerFormHandler
{

    /**
     * Handle the installer form.
     *
     * @param Form                         $form
     * @param FormInput                    $input
     * @param StreamsDistributionInstaller $distributionInstaller
     */
    public function handle(Form $form, FormInput $input, StreamsDistributionInstaller $distributionInstaller)
    {
        $distributionInstaller->install($input->get($form));

        $form->setResponse(redirect('/'));
    }
}
 