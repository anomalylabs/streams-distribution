<?php namespace Anomaly\StreamsDistribution\Addon\FieldType;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;

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
    protected $inputView = 'anomaly.distribution.streams::addon/field_type/license/input';

    /**
     * The wrapper view.
     *
     * @var string
     */
    protected $wrapperView = 'anomaly.distribution.streams::addon/field_type/license/wrapper';
}
