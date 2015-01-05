<?php namespace Anomaly\StreamsDistribution\Ui\Form\Handler;

/**
 * Class ActionHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Ui\Form\Handler
 */
class ActionHandler
{

    /**
     * Return the form actions.
     *
     * @return array
     */
    public function handle()
    {
        return [
            'save' => [
                'type' => 'success',
                'text' => 'streams::button.install',
            ]
        ];
    }
}
