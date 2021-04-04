<?php


namespace project\models;


use core\mvc\Model;
use core\SessionShell;

class UserModel extends Model
{
    /**
     * Parameters will be initiated
     *
     * @var int
     */
    private $id;
    private $userUrn;
    private $userName;
    private $pageData;

    /**
     * checkHaveCommentInDB
     *
     * Checks if there is at least one comment
     * @return bool
     */
    public function checkHaveCommentInDB(){

        $field = 'MAX('.FIELD_ID_COMMENT.')';
        if($this->getAllOnCondition(TABLE_COMMENTS,$field)[0]){
            return true;
        };
        return false;
    }

    /**
     * mainUserAction
     *
     * This action starts processing the comment and returns data from the database.
     * @param array $param
     * @return array
     */
    public function mainUserAction($param,$controllerObj){
        $this->userUrn = $controllerObj->userUrn;
        $this->userName = $controllerObj->userName;
        $this->id= $controllerObj->id;
        if($_POST){
            return $this->checksAndSavesData($param,$controllerObj);
        }
        $arrMessage = array();
        if(isset($param["message"])){
            $arrMessage["arrMessage"] = $this->getMessage($param["message"]);
        }

        return array_merge($this->pagination($param["page"],$controllerObj),$arrMessage,$this->userUrn,$this->userName,$this->pageData);
    }

    /**
     * pagination
     *
     * Gets comments from the database according to the current pagination
     * @param  int $currentPage
     * @return array
     */
    private function pagination($currentPage = 0,$controllerObj ){

        $arrPostsId = array_chunk($this->getAllPostsId(),3);

        $this->pageData["countPage"] = count($arrPostsId);
        $this->pageData["currentPage"] = $currentPage;


        if($currentPage> $this->pageData["countPage"] || $currentPage <= 0){
            $controllerObj->setOptions("Ошибка 404",'default','error');
            return ["message" => "Ошибка 404.Страница не найдена!"];
        }

        $this->checkCurrentPagePosition($currentPage);

        $arrPostsId = array_combine(range(1, $this->pageData["countPage"]), $arrPostsId);


        return $this->getDefinitePosts($arrPostsId[$currentPage]);

    }

    /**
     * checkCurrentPagePosition
     *
     * Checks the current page position
     * @param int $currentPage
     * @return void
     */
    private function checkCurrentPagePosition($currentPage){
        if(!isset($_SESSION["Pages"][0]) ){
            $this->setPagesInSession([$currentPage,$currentPage+1,$currentPage+2]);
        }

        if(isset($_SESSION["Pages"][2]) && ($_SESSION["Pages"][2]< $currentPage || $_SESSION["Pages"][0] > $currentPage)
            && $currentPage+2 <= $this->pageData["countPage"]){

            $this->setPagesInSession([$currentPage,$currentPage+1,$currentPage+2]);

        }elseif(isset($_SESSION["Pages"][0]) && ($_SESSION["Pages"][0] > $currentPage)
            && $currentPage+2 <= $this->pageData["countPage"]){

            $this->setPagesInSession([$currentPage,$currentPage+1,$currentPage+2]);
        }elseif( $currentPage == $this->pageData["countPage"]){
            $this->setPagesInSession([$currentPage]);

        }elseif (($currentPage+1) == $this->pageData["countPage"]) {
            $this->setPagesInSession([$currentPage,$currentPage+1]);

        }
    }

    /**
     * setPagesInSession
     *
     * Saving pages in session
     * @param array $arrPages
     */
    private function setPagesInSession($arrPages){
        SessionShell::set("Pages", $arrPages);
    }

    /**
     * checksAndSavesData
     *
     * Checks and saves comments
     * @param array $param
     * @return array
     */
    private function checksAndSavesData($param,$controllerObj){
        $arrMessage = $this->passValidation($_POST);

        if($arrMessage[0]===true && count($arrMessage)==1){

            $this->saveCommentToDB($this->id,$_POST["text"]);
            return array_merge($this->pagination($param["page"],$controllerObj),$this->getMessage("addNewPost"),$this->userUrn,$this->userName,$this->pageData);

        }else{
            $validatorMessage = ["arrMessage"=>$arrMessage];
            return array_merge($this->pagination($param["page"],$controllerObj),$validatorMessage,$this->userUrn,$this->userName,$this->pageData);
        }
    }

    /**
     * saveCommentToDB
     *
     * Saves comments to the database.
     * @param int $id
     * @param string $text
     */
    private function saveCommentToDB($id,$text){
        $data = ["id_user"=>$id, "data"=>TODAY,"text"=>$text];
        $this->save(TABLE_COMMENTS, $data);
    }

    /**
     * getMessage
     *
     * Returns a message about the action performed.
     * @param string $message
     * @return array
     */
    private function getMessage($message){
        switch ($message){
            case "welcome":
                return ["Вход произведен! Добро пожаловать!"];
                break;
            case "newuser":
                return  ["Регистрация завершина! Добро пожаловать!"];
                break;
            case "addNewPost":
                return  ["Ваше сообщение успешно добавлено!"];
                break;
            case "deletePost":
                return  ["Ваше сообщение успешно удалено!"];
                break;
        }
    }

    /**
     * deleteCommentFromDB
     *
     * This method deletes the user's comment from database
     * @param array $param
     */
    public function deleteCommentFromDB($param){
        $condition = FIELD_ID_COMMENT."=".$param["commentId"];
        $this->delete(TABLE_COMMENTS, $condition);
}
}