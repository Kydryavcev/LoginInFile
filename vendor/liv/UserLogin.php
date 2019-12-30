<?php 
namespace vendor\liv;

class UserLogin
{
    public $fname = "usersInfo.txt";

    public function __construct($login, $password)
    {
        $data = @file($this->fname);
        $errros = array();
        for ($i=0; $i < count($data); $i++) 
        { 
            $result = explode ('|', $data[$i]);
            if ($result[1] == $login) 
            {
                $errros[0] = null;
                if (trim($result[2]) == trim($password))
                {

                    if (!empty($_REQUEST['saveUser']))
                    {
                        setcookie("id", $result[0], time() + 3600);
                    }

                    $_SESSION['login'] = $result[0];
                    $errros[1] = null;
                    return 'Вы успешно вошли в аккаунт!<br>';
                }else {
                    return 'Не верный пароль<br>';
                }

            }else{
                $errros[0] = 'Не верный логин<br>';
            }           
        }
        for ($i=0; $i < count($errros); $i++) 
        { 
            if (!empty($errros[$i])) 
            {
                return $errros[$i];
            }
        }
        
    }

}
