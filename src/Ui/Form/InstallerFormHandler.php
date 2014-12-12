<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Ui\Form;

use Anomaly\Streams\Addon\Distribution\Streams\StreamsDistributionInstaller;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class InstallerFormHandler
{

    public function handle(FormBuilder $builder, StreamsDistributionInstaller $distributionInstaller)
    {
        $form = $builder->getForm();

        $distributionInstaller->install($form->pullInput('include'));

        $form->setResponse(redirect('/'));
    }
}
 