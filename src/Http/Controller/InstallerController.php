<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Http\Controller;

use Anomaly\Streams\Addon\Distribution\Streams\Ui\Form\InstallerFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

class InstallerController extends PublicController
{

    public function index(InstallerFormBuilder $form)
    {
        return $form->render();
    }
}
 