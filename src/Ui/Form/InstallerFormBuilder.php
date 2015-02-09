<?php namespace Anomaly\StreamsDistribution\Ui\Form;

use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\StreamsDistribution\Ui\Form\Command\SetFormOptions;

/**
 * Class InstallerFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Ui\Form
 */
class InstallerFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var string
     */
    protected $fields = 'Anomaly\StreamsDistribution\Ui\Form\Handler\FieldsHandler@handle';

    /**
     * The form actions.
     *
     * @var string
     */
    protected $actions = 'Anomaly\StreamsDistribution\Ui\Form\Handler\ActionsHandler@handle';

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
 
