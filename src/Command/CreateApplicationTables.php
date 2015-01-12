<?php namespace Anomaly\StreamsDistribution\Command;

/**
 * Class CreateApplicationTables
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Application\Command
 */
class CreateApplicationTables
{

    /**
     * The application name.
     *
     * @var
     */
    protected $name;

    /**
     * The application domain.
     *
     * @var
     */
    protected $domain;

    /**
     * The application reference.
     *
     * @var
     */
    protected $reference;

    /**
     * Create a new CreateApplicationTables instance.
     *
     * @param $name
     * @param $domain
     * @param $reference
     */
    public function __construct($name, $domain, $reference)
    {
        $this->name      = $name;
        $this->domain    = $domain;
        $this->reference = $reference;
    }

    /**
     * Get the application domain.
     *
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Get the application name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the application reference.
     *
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }
}
