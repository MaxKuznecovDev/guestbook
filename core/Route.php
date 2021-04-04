<?php


namespace core;

class Route
{
    /**
     * user URN
     *
     * @var string
     */
    private $path;

    /**
     * Controller will be initiated
     *
     * @var string
     */
    private $controller;

    /**
     * Action will be initiated
     *
     * @var string
     */
    private $action;

    /**
     * __construct
     *
     * Saving user urn, controller and action.
     * @param string $path
     * @param string $controller
     * @param string $action
     *
     */
    public function __construct($path, $controller, $action)
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * __get
     *
     * Return private property.
     * @param string $property
     * @return string
     *
     */
    public function __get($property)
    {
        return $this->$property;
    }
}