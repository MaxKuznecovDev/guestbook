<?php


namespace core;


class Page
{
    /**
     * The layout will be connection with view
     *
     * @var string
     */
    private $layout;

    /**
     * The title will be passed in view
     *
     * @var string
     */
    private $title;

    /**
     * The view will be display to user
     *
     * @var string
     */
    private $view;

    /**
     * The data will be pass to new view
     *
     * @var array
     */
    private $data;

    /**
     * __construct
     *
     * Saving layout, title,view and data.
     * @param string $layout
     * @param string $title
     * @param string $view
     * @param array $data
     *
     */
    public function __construct($layout, $title, $view, $data)
    {
        $this->layout = $layout;
        $this->title  = $title;
        $this->view   = $view;
        $this->data   = $data;
    }

    /**
     * __get
     *
     * Return private property.
     * @param string $property
     * @return string|array
     *
     */
    public function __get($property)
    {
        return $this->$property;
    }
}