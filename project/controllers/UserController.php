<?php


namespace project\controllers;

use core\mvc\Controller;;
use core\Validator;
use project\models\UserModel;

class UserController extends Controller
{
    /**
     * Parameters will be initiated
     *
     * @var int
     */
    public $id;
    public $userUrn;
    public $userName;

    /**
     * index
     *
     * This action checks the user ID and launches the main function
     * @param array $param
     * @return array
     */
    public function index($param){
        $this->setUserProperties();
        if(isset($_SESSION["id_user"] ) && $_SESSION["id_user"] == $this->id){
            $this->setOptions($this->userName["userName" ],'default','user');
            $userModel = new UserModel();
            if(!$userModel->checkHaveCommentInDB() && !$_POST){
                $arrMessage["arrMessage"] = ["Пока не было оставлено ни одного комментария! Будьте первым!"];
                return array_merge($arrMessage,$this->userUrn,$this->userName);
            };

            return $userModel->mainUserAction($param,$this);

        }else{
            header("Location: ".USER_URL."/login/notauth");
        }
    }

    /**
     * deleteComment
     *
     * This action deletes the user's comment
     * @param array $param
     */
    public function deleteComment($param){
        $userModel = new UserModel();
        $userModel->deleteCommentFromDB($param);
        $userUrn = $this->getUserURN();
        header("Location: ".USER_URL."/".$userUrn["userUrn"]."/page/1/deletePost");

    }
    /**
     * setUserProperties
     *
     * save the user ID,name, and urn
     * @return void
     */
    private function setUserProperties(){
        $this->userUrn = $this->getUserURN();
        $this->id = $this->getUserIdFromUrn();
        $this->userName = $this->getUserName();
    }

    /**
     * getUserURN
     *
     * Gets a user urn
     * @return array
     */
    private function getUserURN(){

        preg_match('#(\w+\/\d+)#', REQUEST_USER,$matches);
        return ["userUrn"=> $matches[0]];
    }

    /**
     * getUserIdFromUrn
     *
     * Gets a user id
     * @return mixed
     */
    private function getUserIdFromUrn(){
        preg_match('#/(\d+)#', REQUEST_USER,$matches);
        return  $matches[1];
    }

    /**
     * getUserName
     *
     * Gets a user name
     * @return array
     */
    private function getUserName(){
        $condition = FIELD_ID."=$this->id";
        $userName = $this->db->getAllOnCondition(TABLE_USERS,FIELD_NAME,$condition);

        if($userName){
            return ["userName" =>$userName['NAME']];
        }

    }


}