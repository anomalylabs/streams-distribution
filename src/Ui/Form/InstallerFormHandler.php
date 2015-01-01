<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Ui\Form;

use Anomaly\Streams\Addon\Distribution\Streams\StreamsDistributionInstaller;
use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormInput;

/**
 * Class InstallerFormHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Distribution\Streams\Ui\Form
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
 