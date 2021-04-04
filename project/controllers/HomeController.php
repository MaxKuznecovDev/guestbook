<?php


namespace project\controllers;
use core\mvc\Controller;


class HomeController extends Controller
{
    /**
     * index
     *
     * Sets the Home view, clears $_SESSION and returns all posts
     * @return array
     */
    public function index(){

        $this->setOptions("Добро пожаловать в гостевую книгу!");

        if(!empty($_SESSION["id_user"])){
            $this->session->delete('id_user');
            $this->session->delete('Pages');

        }

        return $this->getAllPosts();
    }


}