<?php


namespace project\controllers;


use core\mvc\Controller;
use project\models\EditModel;

class EditController extends Controller
{
    /**
     * editComment
     *
     * Edits the comment
     * @param array $param
     * @return array
     */
    public function editComment($param)
    {
        $this->setOptions("Редактировать",'default','edit');
        $editModel = new EditModel();
        if($_POST){
            return $editModel->checkingAndUpdateComment($param);
        }
        return array_merge($editModel->getComment($param["commentId"]), $param);
    }

}