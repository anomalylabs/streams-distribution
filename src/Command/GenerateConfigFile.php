<?php namespace Anomaly\StreamsDistribution\Command;

class GenerateConfigFile
{
    protected $key;

    protected $locale;

    protected $timezone;

    function __construct($key, $locale, $timezone)
    {
        $this->key      = $key;
        $this->locale   = $locale;
        $this->timezone = $timezone;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return mixed
     */
    public function getTimezone()
    {
        return $this->timezone;
    }
}
 