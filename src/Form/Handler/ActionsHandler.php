<?php namespace Anomaly\StreamsDistribution\Form\Handler;

/**
 * Class ActionsHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Form\Handler
 */
class ActionsHandler
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
                'text' => 'anomaly.distribution.streams::button.install',
            ]
        ];
    }
}
