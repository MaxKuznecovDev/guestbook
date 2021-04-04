<?php


namespace project\controllers;


use core\mvc\Controller;;
use core\Validator;
use project\models\VerificationModel;

class verificationController extends Controller
{

    /**
     * loginUser
     *
     * Start the login procedure
     * @param array $param
     * @return  array
     *
     */
    public function loginUser($param = [])
    {
        $this->setOptions("Авторизация", "login", "login");
        $verificationModel = new VerificationModel();
        if ($_POST) {
            return $verificationModel->mainLoginAction();
        }
        return $verificationModel->checkAuthorization($param);
    }

    /**
     * registrationUser
     *
     * Start the registration procedure
     * @param array $param
     * @return array
     */
    public function registrationUser($param = [])
    {
        $this->setOptions("Регистрация", "registration", "registration");
        $verificationModel = new VerificationModel();
        if ($_POST) {
            return $verificationModel->mainRegistrationAction();
        }
        return $verificationModel->checkAuthorization($param);
    }

}