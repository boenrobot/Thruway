<?php


/**
 * Class UserDb
 */
class UserDb implements \Thruway\Authentication\WampCraUserDbInterface
{

    /**
     * @var array
     */
    private $users;

    function __construct()
    {
        $this->users = [];
    }

    /**
     * @param $userName
     * @param $password
     * @param null $salt
     */
    function add($userName, $password, $salt = null)
    {
        if ($salt !== null) {
            $key = \Thruway\Authentication\WampCraAuthProvider::getDerivedKey($password, $salt);
        } else {
            $key = $password;
        }

        $this->users[$userName] = ["authid" => $userName, "key" => $key, "salt" => $salt];
    }

    /**
     * @param string $authId
     * @return boolean
     */
    function get($authId)
    {
        if (isset($this->users[$authId])) {
            return $this->users[$authId];
        } else {
            return false;
        }
    }

} 