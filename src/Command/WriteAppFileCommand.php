<?php namespace Streams\Addon\Distribution\Base\Command;

class WriteAppFileCommand
{
    /**
     * @var
     */
    protected $timezone;

    /**
     * @var
     */
    protected $locale;

    /**
     * @param $locale
     * @param $timezone
     */
    function __construct($locale, $timezone)
    {
        $this->locale   = $locale;
        $this->timezone = $timezone;
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
 