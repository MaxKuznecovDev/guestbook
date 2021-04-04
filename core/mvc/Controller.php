<?php
namespace core\mvc;

use core\Page;
use core\SessionShell;
use core\Validator;
use PDO;
class Controller
{
    /**
     * The view will be display to user
     *
     * @var string
     */
    protected $view;

    /**
     * The layout will be connection with view
     *
     * @var string
     */
    protected $layout;

    /**
     * The title will be passed in view
     *
     * @var string
     */
    protected $title;

    /**
     * An object of the Model class contains a database connection and functions for working with it.
     *
     * @var object
     */
    protected $db;

    /**
     * An object of the Session class contains a start of the session and functions for working with it.
     *
     * @var object
     */
    protected $session;

    /**
     * __construct
     *
     * Creating and saving new objects of Model and Session class.
     *
     */
    public function __construct(){
        $this->db = new Model();
        $this->session=new SessionShell();
        $this->setOptions();
    }

    /**
     * render
     *
     * We form object with layout,title, view and data for display to user
     * @param array $data
     * @return object Page::class
     *
     */
    public function render($data) {
        return new Page($this->layout, $this->title, $this->view, $data);
    }

    /**
     * getAllPosts
     *
     * Doing request to database and get all posts from it.
     * @return array
     *
     */
    protected function getAllPosts(){
        $tables = [TABLE_USERS,TABLE_COMMENTS];
        $fields=[FIELD_ID_COMMENT,FIELD_ID_USER,FIELD_NAME,FIELD_DATA,FIELD_TEXT];
        $condition = TABLE_COMMENTS.".".FIELD_ID_USER."=".TABLE_USERS.".".FIELD_ID." ORDER BY ".FIELD_ID_COMMENT." DESC";
        return ["comments" => $this->db->getAllOnCondition($tables,$fields, $condition,true)];
    }

    /**
     * setLayout
     *
     * Set layout,title,view
     * @param string $nameLayout
     * @param string $nameTitle
     * @param string $nameView
     * @return void
     */
    public function  setOptions($nameTitle= 'title',$nameLayout='default',$nameView ='home'){
        $this->layout = $nameLayout;
        $this->title = $nameTitle;
        $this->view = $nameView;
    }


}