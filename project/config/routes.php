<?php
/**
 * We are giving binding users urn with controllers and actions.
 * @param user URN. After ":" goes name of variable. This variable will be created and it will be has parameter from urn.
 * @param Controller will be initiated
 * @param Action will be initiated
 *
 * @return array
 */
use \core\Route;
return [
    new Route('/', 'home', 'index'),
    new Route('/login/', 'verification', 'loginUser'),
    new Route('/login/:auth/', 'verification', 'loginUser'),
    new Route('/registration/', 'verification', 'registrationUser'),
    new Route('/user/:userId/page/:page/:message/', 'user', 'index'),
    new Route('/user/:userId/delete/:commentId/', 'user', 'deleteComment'),
    new Route('/user/:userId/edit/:commentId/', 'edit', 'editComment'),
    new Route('/user/:userId/page/:page/', 'user', 'index')
];
