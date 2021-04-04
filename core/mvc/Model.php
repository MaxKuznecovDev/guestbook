<?php


namespace core\mvc;


use core\Validator;
use PDO;

class Model
{
    /**
     * Saving PDO object
     *
     * @var object of the PDO class
     */
    private static $link;

    /**
     * __construct
     *
     * Creating new connection with database
     *
     */
    public function __construct()
    {
        if (!self::$link) {
            try{
                self::$link = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            }catch (\PDOException $e){
                echo "Error connecting to database!";
                die();

            }

        }

    }
    public function getAllOnCondition($tables,$fields, $condition ='',$fetchall=false, $fetchStyle = PDO::FETCH_BOTH){
        if(is_array($tables)){
            $tables = implode(",",$tables);
        }
        if(is_array($fields)){
            $fields = implode(",",$fields);
        }

        if($condition){
            $statement = "SELECT ".$fields." FROM ". $tables. " WHERE $condition";
        }else{
            $statement = "SELECT ".$fields." FROM ". $tables;
        }


        if($fetchall){

            return self::$link->query($statement)->fetchall($fetchStyle);
        }else{
            return self::$link->query($statement)->fetch();
        }

    }

    /**
     * save
     *
     * Save data to the database
     * @param string $table
     * @param array $data
     * @return string
     */
    public function save($table,$data)
    {
        $field="";
        $value="";
        foreach ($data as $col=>$val){
            $field.=$col.',';
            $value.="'".$val."',";
        }
        $field = substr($field,0,-1);
        $value = substr($value,0,-1);
        $statement = "INSERT INTO $table($field) VALUES ($value)";
        self::$link->query($statement);

        return self::$link->lastInsertId();
    }

    /**
     * delete
     *
     * Delete data to the database
     * @param string $table
     * @param string $condition
     * @return false|\PDOStatement
     */
    public function delete($table, $condition)
    {
        $statement = "DELETE FROM $table WHERE $condition";
        return self::$link->query($statement);
    }

    /**
     * update
     *
     * Update data to the database
     * @param string $table
     * @param string $field
     * @param string $value
     * @param string $condition
     * @return false|\PDOStatement
     */
    public function update($table,$field,$value,$condition){

        $statement = "UPDATE $table SET $field = '".$value."' WHERE $condition";
        return self::$link->query($statement);
    }

    /**
     * passValidation
     *
     * Passing data from $_POST to validation check
     * @param array $post
     * @return array
     *
     */
    protected function passValidation($post){
        $validator = new Validator();
        $userInputDate = $validator->doValidation($post);
        return array_unique ( $userInputDate );
    }

    /**
     * getAllPostsId
     *
     * Doing request to database and get post ids from it.
     * @return array
     *
     */
    protected function getAllPostsId(){
        $tables = [TABLE_COMMENTS];
        $fields=[FIELD_ID_COMMENT];
        $condition = FIELD_ID_COMMENT." IS NOT NULL ORDER BY ".FIELD_ID_COMMENT." DESC";
        return  $this->getAllOnCondition($tables,$fields, $condition,true, PDO::FETCH_COLUMN);
    }

    /**
     * getDefinitePosts
     *
     * Doing request to database and get definite posts from it.
     * @return array
     *
     */
    protected function getDefinitePosts($arrPostsId){

        $tables = [TABLE_USERS,TABLE_COMMENTS];
        $fields=[FIELD_ID_COMMENT,FIELD_ID_USER,FIELD_NAME,FIELD_DATA,FIELD_TEXT];

        $strPosts = '';
        foreach ($arrPostsId as $postId){
            $strPosts .= $postId.",";
        }
        $strPosts = rtrim($strPosts,",");
        $condition = TABLE_COMMENTS.".".FIELD_ID_USER."=".TABLE_USERS.".".FIELD_ID." AND ".FIELD_ID_COMMENT." IN(".$strPosts.") ORDER BY ".FIELD_ID_COMMENT." DESC";
        return ["comments" => $this->getAllOnCondition($tables,$fields, $condition,true)];
    }
}