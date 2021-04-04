<?php

namespace core;
class SessionShell
{
    /**
     * SessionShell constructor.
     *
     * Start session
     */
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * set
     *
     * Set the new properties to $_SESSION
     * @param string $name
     * @param string $value
     * @return void
     */
    public static function set($name, $value)
    {
        $_SESSION[$name]=$value;
    }


    /**
     * delete
     *
     * Delete the properties to $_SESSION
     * @param string $name
     * @return void
     */
    public function delete($name)
    {
        unset($_SESSION[$name]);
    }


}