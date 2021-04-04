<?php


namespace core;


class Track
{
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
     * Parameters will be initiated
     *
     * @var array
     * @var null
     */
    private $params;

    /**
     * __construct
     *
     * Saving controller, action and parameters.
     * @param string $controller
     * @param string $action
     * @param array|null $params
     *
     */
    public function __construct($controller, $action, $params=null)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
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