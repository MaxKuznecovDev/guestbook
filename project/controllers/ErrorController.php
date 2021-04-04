<?php


namespace project\controllers;


use core\mvc\Controller;

class ErrorController extends Controller
{
    /**
     * notFound
     *
     * Sets the Error view  and returns an error message to the user.
     * @return array
     */
             public function notFound(){
                 $this->setOptions("Ошибка 404",'default','error');
                 return ["message" => "Ошибка 404.Страница не найдена!"];
             }

}