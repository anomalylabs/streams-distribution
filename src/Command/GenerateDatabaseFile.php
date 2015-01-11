<?php namespace Anomaly\StreamsDistribution\Command;

class GenerateDatabaseFile
{

    protected $driver;

    protected $host;

    protected $database;

    protected $username;

    protected $password;

    function __construct($driver, $host, $database, $username, $password)
    {
        $this->host     = $host;
        $this->driver   = $driver;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
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
    public function getDriver()
    {
        return $this->driver;
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
    public function getUsername()
    {
        return $this->username;
    }
}
 