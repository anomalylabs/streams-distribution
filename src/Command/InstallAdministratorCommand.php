<?php namespace Anomaly\Streams\Distribution\Streams\Command;

class InstallAdministratorCommand
{
    /**
     * @var
     */
    protected $username;

    /**
     * @var
     */
    protected $email;

    /**
     * @var
     */
    protected $password;

    /**
     * @param $username
     * @param $email
     * @param $password
     */
    function __construct($username, $email, $password)
    {
        $this->email    = $email;
        $this->password = $password;
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
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
 