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
     * The form fields.
     *
     * @var string
     */
    protected $fields = 'Anomaly\StreamsDistribution\Form\Handler\FieldsHandler@handle';

    /**
     * The form actions.
     *
     * @var string
     */
    protected $actions = 'Anomaly\StreamsDistribution\Form\Handler\ActionsHandler@handle';

    /**
     * Create a new InstallerFormBuilder instance.
     *
     * @param Form $form
     */
    public function __construct(Form $form)
    {
        $options = $form->getOptions();

        $this->dispatch(new SetFormOptions($options));

        parent::__construct($form);
    }
}
 
