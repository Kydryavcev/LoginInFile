<?php 
namespace vendor\liv;
require_once 'GetUsers.php';

use vendor\liv\GetUsers;

class UserInsert extends GetUsers
{
    public $fname = "usersInfo.txt";

    public function __construct($login, $password)
    {
        $arrCount = self::getAll();
        for ($i=0; $i < count($arrCount); $i++) { 
            $result = explode ('|', $arrCount[$i]);
            if ($login == $result[1]) {
                echo 'Пользователь с таким логином уже существует';
                return false;
            }
        }
        $id_last = array_pop($arrCount);
        $keyUser = $id_last[0] +1;        
        $password = password_hash(trim($password), PASSWORD_DEFAULT);
        $_SESSION['login'] = $keyUser;        
        $f = fopen($this->fname, "a");
        $data = "$keyUser|$login|$password";
        fputs($f, $data."\n");
        fclose($f);
        echo 'Вы успешно зарегистрировались!<br>';
    }

}
