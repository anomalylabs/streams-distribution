<?php namespace Anomaly\StreamsDistribution\Form;

use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\StreamsDistribution\Form\Command\SetFormOptions;

/**
 * Class InstallerFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Form
 */
class InstallerFormBuilder extends FormBuilder
{

    /**
     * The form actions.
     *
     * @var array
     */
    protected $actions = [
        'save' => [
            'type' => 'success',
            'text' => 'anomaly.distribution.streams::button.install',
        ]
    ];

    /**
     * Create a new InstallerFormBuilder instance.
     *
     * @param Form $form
     */
    public function __construct(Form $form)
    {
        $this->dispatch(new SetFormOptions($form->getOptions()));

        parent::__construct($form);
    }
}
 
