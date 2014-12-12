<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Addon\FieldType;

use Anomaly\Streams\Addon\FieldType\Checkboxes\CheckboxesFieldType;

/**
 * Class LicenseCheckboxesFieldType
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Distribution\Streams\Addon\FieldType
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
 