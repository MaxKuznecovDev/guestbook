<?php


namespace core;


class Router
{
    /**
     * getTrack
     *
     * Passing through array Routes, searching for a match with URN and get object Track::class.
     * @param array $routes
     * @param string $urn
     * @return  object
     *
     */
    public function getTrack($routes, $urn)
    {
        if(substr($urn, -1)!="/"){
            $urn.="/";
        }
        foreach ($routes as $route) {

            $arrParam = $this->checkRouteUrn($route->path,$urn);
            if(is_array ($arrParam)){
               return new Track($route->controller, $route->action, $arrParam);
            }

        }
     return new Track('error', 'notFound');
    }

    /**
     * checkRouteUrn
     *
     * Checking user urn with route and if we have match will be return array with parameters or empty.
     * In other case return false.
     * @param string $route 
     * @param string $urn
     * @return  array
     * @return boolean
     * 
     */
    private function checkRouteUrn($route,$urn){
        $regParamUrn = '#:(\w*)\/#';
        preg_match_all($regParamUrn, $route,$arrMatchesParam,PREG_SET_ORDER);

        $regUrn = '(\w*)/';
        $regAllUrn = '#^'.preg_replace($regParamUrn, $regUrn, $route).'$#';

        preg_match_all($regAllUrn, $urn,$arrMatchesUrn, PREG_SET_ORDER);

        if(isset($arrMatchesUrn[0])){

            $arrParam=array();
            array_splice($arrMatchesUrn[0],0,1);
            foreach ($arrMatchesParam as $value){
                array_push($arrParam,$value[1]);
            }
            $arrParam = array_combine($arrParam,$arrMatchesUrn[0]);
                return $arrParam;

        }
        
     return false;
    }

}