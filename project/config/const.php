<?php
define("HTTP_HOST",$_SERVER['HTTP_HOST']);
define("HTTP_PROTOCOL",'http://');
define("USER_URL",HTTP_PROTOCOL.HTTP_HOST);


define("ROOT",$_SERVER['DOCUMENT_ROOT']);
define("CONFIG",ROOT.'/project/config');

define("CONTROLLERS",'project\controllers\\');
define("LAYOUTS", ROOT."/project/layouts/");
define("VIEWS", ROOT."/project/views/");




define("REQUEST_USER",trim($_SERVER['REQUEST_URI'],'/'));


