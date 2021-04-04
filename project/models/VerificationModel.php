<?php


namespace project\models;


use core\mvc\Model;
use core\SessionShell;

class VerificationModel extends Model
{

    /**
     * mainLoginAction
     *
     * Checking the user's data for authentication.
     * If everything is fine, then log in to the site. In another case, display a message with problems.
     * @return array
     */
    public function mainLoginAction(){
        $arrMessage = $this->passValidation($_POST);
        if($arrMessage[0]===true && count($arrMessage)==1){
            $userId=$this->getIdByLoginPass();
            if($userId){

                $this->passToUserAccount($userId["ID"],"welcome");
            }
            return [ "arrMessage"=>["Пользователь не зарегистрирован"],"post"=>$_POST];
        }else{
            return ["arrMessage"=>$arrMessage,"post"=>$_POST];
        }
    }

    /**
     * mainRegistrationAction
     *
     * Checking the user's data for registration.
     * If everything is fine, then registration and log in to the site. In another case, display a message with problems.
     * @return array
     */
    public function mainRegistrationAction(){
        $arrMessage = $this->passValidation($_POST);
        if($arrMessage[0]===true && count($arrMessage)==1){
            return $this->saveUserToDB();
        }else{
            return ["arrMessage"=>$arrMessage,"post"=>$_POST];
        }
    }

    /**
     * saveUserToDB
     *
     * Create a new user and save their data in the database
     * @return array
     */
    private function saveUserToDB(){
        if(!$this->getEmail()){
            unset($_POST["passwordRepeat"]);
            $userId = $this->save(TABLE_USERS,$_POST);
            $this->passToUserAccount($userId,"newuser");
        }
        return [ "arrMessage"=>["Email уже зарегистрирован"],"post"=>$_POST];
    }

    /**
     * passToUserAccount
     *
     * Redirecting the user to his page.
     * @param int $id
     * @param string $welcomeMessage
     * @return void
     */
    private function passToUserAccount($id,$welcomeMessage){
        SessionShell::set('id_user', $id);
        header("Location: ".USER_URL."/user/$id/page/1/".$welcomeMessage);
    }

    /**
     * checkAuthorization
     *
     * Checking User Authorization.
     * @param array $param
     * @return array
     */
    public function checkAuthorization($param){
        if(isset($param["auth"]) && $param["auth"] == "notauth"){
            return [ "arrMessage"=>["Авторизуйтесь, чтобы начать новую сессию!"]];
        }
        return ["post"=>[
            "name"=>"",
            "email"=>"",
            "login"=>"",
            "password"=>"",
            "passwordRepeat"=>"",

        ]];
    }

    /**
     * issetEmail
     *
     * Get email from database.
     * @return array|mixed
     */
    private function getEmail(){
        $condition = FIELD_EMAIL."='".$_POST["email"]."'";
        return $this->getAllOnCondition(TABLE_USERS, FIELD_ID,$condition);
    }

    /**
     *
     * Get an ID by username and password.
     * @return array|mixed
     */
    private function getIdByLoginPass(){
        $condition = FIELD_PASS."='".$_POST["password"]."' AND ".FIELD_LOGIN."='".$_POST["login"]."'";
        return $this->getAllOnCondition(TABLE_USERS, FIELD_ID,$condition);
    }
}