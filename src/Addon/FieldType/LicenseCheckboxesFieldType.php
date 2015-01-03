<?php namespace Anomaly\StreamsDistribution\Addon\FieldType;

use Anomaly\CheckboxesFieldType;

/**
 * Class LicenseCheckboxesFieldType
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution\Addon\FieldType
 */
class LicenseCheckboxesFieldType extends CheckboxesFieldType
{
    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'distribution.streams::addon/field_type/license/input';

    /**
     * The wrapper view.
     *
     * @var string
     */
    protected $wrapperView = 'distribution.streams::addon/field_type/license/wrapper';

    /**
     * Get the view data.
     *
     * @return string
     */
    public function getInputData()
    {
        $data = parent::getInputData();

        $data['agree']   = trans($this->pullConfig('agree'));
        $data['license'] = value($this->pullConfig('license'));

        return $data;
    }
}
 