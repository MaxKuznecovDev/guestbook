<?php


namespace project\models;


use core\mvc\Model;

class EditModel extends Model
{
    /**
     * checkingAndUpdateComment
     *
     * Checks the correctness of the comment and updates it.
     * @param array $param
     * @return array
     */
    public function checkingAndUpdateComment($param){
        $arrMessage = $this->passValidation($_POST);
        if($arrMessage[0]===true && count($arrMessage)==1){
            $this->updateComment($param);
        }else{
            $validatorMessage = ["arrMessage"=>$arrMessage];
            return array_merge($this->getComment($param["commentId"]), $param,$validatorMessage);
        }
    }
    /**
     * updateComment
     *
     * Updating a comment.
     * @param array $param
     * @return  null
     */
    private function updateComment($param){
        $condition = TABLE_COMMENTS.".".FIELD_ID_COMMENT."=".$param["commentId"];
        $this->update(TABLE_COMMENTS,FIELD_TEXT,$_POST["text"],$condition);

        header("Location: ".USER_URL."/user/".$param["userId"]."/page/".$_SESSION["Pages"][0]."/");
    }
    /**
     * getComment
     *
     * Gets a comment.
     * @param int $commentId
     * @return array
     */
    public function getComment($commentId){
        $tables = [TABLE_COMMENTS];
        $fields=[FIELD_DATA,FIELD_TEXT];
        $condition = TABLE_COMMENTS.".".FIELD_ID_COMMENT."=".$commentId;
        return ["comment" => $this->getAllOnCondition($tables,$fields, $condition)];
    }
}