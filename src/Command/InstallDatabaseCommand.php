<?php namespace Anomaly\Streams\Distribution\Streams\Command;

class InstallDatabaseCommand
{
    /**
     * @var
     */
    protected $driver;

    /**
     * @var
     */
    protected $host;

    /**
     * @var
     */
    protected $database;

    /**
     * @var
     */
    protected $user;

    /**
     * @var
     */
    protected $password;

    /**
     * @param $driver
     * @param $host
     * @param $database
     * @param $user
     * @param $password
     */
    function __construct($driver, $host, $database, $user, $password)
    {
        $this->user     = $user;
        $this->host     = $host;
        $this->driver   = $driver;
        $this->password = $password;
        $this->database = $database;
    }

    /**
     * @return mixed
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @return mixed
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}
 