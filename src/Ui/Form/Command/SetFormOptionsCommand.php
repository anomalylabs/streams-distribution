<?php namespace Anomaly\StreamsDistribution\Ui\Form\Command;

use Illuminate\Support\Collection;

/**
 * Class SetFormOptionsCommand
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Ui\Form\Command
 */
class SetFormOptionsCommand
{

    /**
     * The form options.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $options;

    /**
     * Create a new SetFormOptionsCommand instance.
     *
     * @param Collection $options
     */
    public function __construct(Collection $options)
    {
        $this->options = $options;
    }

    /**
     * Get the form options.
     *
     * @return Collection
     */
    public function getOptions()
    {
        return $this->options;
    }
}
