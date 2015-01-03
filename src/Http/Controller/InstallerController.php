<?php namespace Anomaly\StreamsDistribution\Http\Controller;

use Anomaly\StreamsDistribution\Ui\Form\InstallerFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

class InstallerController extends PublicController
{

    public function index(InstallerFormBuilder $form)
    {
        return $form->render();
    }
}
 