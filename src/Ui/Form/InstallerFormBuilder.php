<?php namespace Anomaly\StreamsDistribution\Ui\Form;

use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Laracasts\Commander\CommanderTrait;

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
    protected $fields = 'Anomaly\StreamsDistribution\Ui\Form\Handler\FieldHandler@handle';

    /**
     * The form actions.
     *
     * @var string
     */
    protected $actions = 'Anomaly\StreamsDistribution\Ui\Form\Handler\ActionHandler@handle';

    /**
     * Create a new InstallerFormBuilder instance.
     *
     * @param Form $form
     */
    public function __construct(Form $form)
    {
        app('validator')->extend(
            'valid_database',
            'Anomaly\StreamsDistribution\Ui\Form\InstallerFormValidator@validateDatabase',
            'anomaly.distribution.streams::field.database_driver.invalid_database'
        );

        $options = $form->getOptions();

        $this->execute('Anomaly\StreamsDistribution\Ui\Form\Command\SetFormOptionsCommand', compact('options'));

        parent::__construct($form);
    }
}
 
