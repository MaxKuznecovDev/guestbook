<?php


namespace core;


class Dispatcher
{
    /**
     * getPage
     *
     * Creating a new object  from defined controller and initiating of the method with parameters.
     * Return object of the Page class  with the processed data.
     * @param Track $track
     * @return  object
     *
     */
    public function getPage(Track $track)
    {
        $classController = CONTROLLERS.ucfirst($track->controller)."Controller";

        $objController = new $classController();

        if(method_exists($objController,$track->action)){

            $method=$track->action;
            if($track->params){
                $data = $objController->$method($track->params);
            }else{
                $data =$objController->$method();
            }

            //Method render exist in class Controller
            return $objController -> render($data);
        }

			return $objController -> render($track->params);
		}
}