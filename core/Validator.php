<?php


namespace core;


class Validator
{
    /**
     * doValidation
     *
     * Returns the result validation
     * @param array $post
     * @return  array
     *
     */
    public function doValidation($post){

        $arrResVal=[];
        $buffer="";
        foreach ($post as $field=>$value){
            $value = strtolower(trim($value));
             switch ($field){
                 case "name":
                     $arrResVal = array_merge($arrResVal,$this->isName($value,$field));
                     break;
                 case "email":
                     $arrResVal = array_merge($arrResVal,$this->isEmail($value,$field));
                     break;
                 case "login":
                     $arrResVal = array_merge($arrResVal,$this->isLogin($value,$field));
                     break;
                 case "password":
                     $buffer = $value;
                     $arrResVal = array_merge($arrResVal,$this->isPassword($value,$field));
                     break;
                 case "passwordRepeat":
                     $arrResVal = array_merge($arrResVal,$this->isPasswordMatches($buffer,$value));
                     break;
                 case "text":
                     $arrResVal = array_merge($arrResVal,$this->isText($value,$field));
                     break;
             }
        }
        return $arrResVal;
    }

    /**
     * isEmail
     *
     * String of email passes through check functions and return array with result.
     * @param string $str
     * @param string $field
     * @return  array
     *
     */
    private function isEmail($str,$field){
        return [
            $this->checkMinLength($str,5,$field),
            $this->checkDog($str,$field),
            $this->checkSymbol($str,$field),
            $this->checkStrChar($str,$field,true),
            $this->checkDotAfterDog($str),
            $this->checkAfterDot($str)
        ];

    }

    /**
     * isName
     *
     * String of name user passes through check functions and return array with result.
     * @param string $str
     * @param string $field
     * @return  array
     *
     */
    private function isName($str,$field){
        return [
            $this->checkMinLength($str,1,$field),
            $this->checkSymbol($str,$field)

        ];
    }

    /**
     * isText
     *
     * String of text passes through check functions and return array with result.
     * @param string $str
     * @param string $field
     * @return  array
     *
     */
    private function isText($str,$field){
        mb_convert_variables("UTF-8", "ASCII,UTF-8,SJIS-win", $str);
        return [
            $this->checkMinLength($str,10,$field),
            $this->checkMaxLength($str,150,$field)
        ];
    }

    /**
     * isLogin
     *
     * String of login user passes through check functions and return array with result.
     * @param string $str
     * @param string $field
     * @return  array
     *
     */
    private function isLogin($str,$field){
        return [
            $this->checkMinLength($str,1,$field),
            $this->checkStrChar($str,$field)
        ];
    }

    /**
     * isPassword
     *
     * String of password user passes through check functions and return array with result.
     * @param string $str
     * @param string $field
     * @return  array
     *
     */
    private function isPassword($str,$field){
        return [
            $this->checkMinLength($str,6,$field),
            $this->checkStrChar($str,$field,true)
        ];
    }

    /**
     * isPasswordMatches
     *
     * String of first time enter password user and string of second time enter password user passes through comparison function
     * and return array with result.
     * @param string $firstPass
     * @param string $secondPass
     * @return  array
     *
     */
    private function isPasswordMatches($firstPass,$secondPass){
        return [
            $this->checkPasswordMatches($firstPass,$secondPass)
        ];
    }

    /**
     * isPasswordMatches
     *
     * Checks strings on coincidence
     * @param string $firstPass
     * @param string $secondPass
     * @return  boolean
     * @return  string
     *
     */
    private function checkPasswordMatches($firstPass,$secondPass){
        if($firstPass===$secondPass){
            return true;
        }else {
            return "Пароли должны совпадать";
        }
    }

    /**
     * checkMinLength
     *
     * Checks the string for minimum length
     * @param string $str
     * @param string $length
     * @param string $field
     * @return  boolean
     * @return  string
     *
     */
    private function checkMinLength($str,$length,$field){
        if(mb_strlen($str,"UTF-8")<$length){
            return "В поле $field введено меньше $length символов";
        }else{
            return true;
        }
    }

    /**
     * checkMaxLength
     *
     * Checks the string for maximum length
     * @param string $str
     * @param string $length
     * @param string $field
     * @return  boolean
     * @return  string
     *
     */
    private function checkMaxLength($str,$length,$field){

        if(mb_strlen($str,"UTF-8")>$length){
            return "В поле $field введено больше $length символов";
        }else{
            return true;
        }
    }

    /**
     * checkDog
     *
     * Checks the string on have the char @
     * @param string $str
     * @param string $field
     * @return  boolean
     * @return  string
     *
     */
    private function checkDog($str,$field){
        if(substr_count($str,"@")!=1){
            return "Поле $field должено содержать специальный символ \"@\"";
        }else{
            return true;
        }
    }

    /**
     * checkSymbol
     *
     * Checks the string on have the symbol
     * @param string $str
     * @param string $field
     * @return  boolean
     * @return  string
     *
     */
    private function checkSymbol($str,$field){
        $arrSymbol = [' ',',', ':', ';', '!', '#', '%', '*', '(', ')', '=', '+', '{', '}', '[', ']', '"', '\'', '/', '\\','|'];
        foreach ($arrSymbol as $symbol){
            if(substr_count($str,$symbol)>=1){

                return "Поле $field не должено содержать"." $symbol";
            }
        }
        return true;
    }

    /**
     * checkStrChar
     *
     * Checks the string on have only  latin symbols
     * @param string $str
     * @param string $field
     * @param boolean $number
     * @return  boolean
     * @return  string
     *
     */
    private function checkStrChar($str,$field,$number=false){
        $arrayKey = array_keys(count_chars($str,1));
        foreach ($arrayKey as $charNumb){
            if($number){
                if($this->charCheck($charNumb,$number)){

                    return "Поле $field должено состоять только из латинских символов и чисел";
                }
            }else{
                if($this->charCheck($charNumb,$number)){

                    return "Поле $field должено состоять только из латинских символов";
                }
            }

        }

        return true;
    }

    /**
     * checkDotAfterDog
     *
     * Checks the string on have dot after the char @
     * @param string $str
     * @return  boolean
     * @return  string
     *
     */
    private function checkDotAfterDog($str){
        if(substr_count($str,'.',strpos($str,'@')) ==0){
            return "После символа \"@\" должна быть как минимум одна \".\"";
        }
        return true;
    }

    /**
     * checkAfterDot
     *
     * Checks the string on have symbols after dot
     * @param string $str
     * @return  boolean
     * @return  string
     *
     */
    private function checkAfterDot($str){
        if($this->charAfterDotCheck($str)){
            return "После последней точки должно быть не менее 2-х и не более 4-х символов, причем наличие цифр не допускается";
        }
        return true;
}

    /**
     * charCheck
     *
     * Checks the number of the character included in the range
     * @param string $charNumb
     * @param boolean $number
     * @return  boolean
     *
     */
    private function charCheck($charNumb,$number){
        if($number){
            if(($charNumb <97 || $charNumb >122) &&($charNumb <48 || $charNumb >57)&& $charNumb!=46 && $charNumb !=64 ){
                return true;
            }

        }else{
            if(($charNumb <97 || $charNumb >122) && $charNumb!=46 && $charNumb !=64 ){
                return true;
            }
        }

        return false;
    }

    /**
     * charAfterDotCheck
     *
     * Checks the string on have symbols after dot
     * @param string $str
     * @return  boolean
     */
    private function charAfterDotCheck($str){

        $strSub = substr ($str,strrpos($str,'.'));
        $strLenAfterDot = strlen($strSub);

        if($strLenAfterDot <= 2 || $strLenAfterDot>4){

            return true;
        }
        $arrayKey = array_keys(count_chars($strSub,1));

        foreach ($arrayKey as $charNumb){
            if($charNumb >48 && $charNumb <57){
                return true;
            }
        }
        return false;
    }



}