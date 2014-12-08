<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Ui\Form;

use Anomaly\Streams\Addon\Distribution\Streams\StreamsDistributionService;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class InstallerFormHandler
{

    public function handle(FormBuilder $builder, StreamsDistributionService $distributionService)
    {
        $form = $builder->getForm();

        $distributionService->install($form->pullInput('include'));

        $form->setResponse(redirect('/'));
    }
}
 