<?php 
namespace vendor\liv;

class User
{
    public $fname = "usersInfo.txt";

    public function insert($login, $password)
    {
        $arrCount = self::getAll();
        for ($i=0; $i < count($arrCount); $i++) { 
            $result = explode ('|', $arrCount[$i]);
            if ($login == $result[1]) {
                return 'Пользователь с таким логином уже существует';
            }
        }
        $id_last = array_pop($arrCount);
        $keyUser = $id_last[0] +1;        
        $_SESSION['login'] = $keyUser;        
        $f = fopen($this->fname, "a");
        $data = "$keyUser|$login|$password";
        fputs($f, $data."\n");
        fclose($f);
        echo 'Вы успешно зарегистрировались!<br>';
    }

    public function login($login, $password)
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
    
    public function getAll()
    {
        return @file($this->fname);
    }

    public function findByID($id)
    {
        $data = @file($this->fname);
        for ($i=0; $i < count($data); $i++) 
        { 
            $result = explode ('|', $data[$i]);
            if ($result[0] == $id) 
            {
                $info = "Пользователь найден!<br>Id пользователя: ".$result[0]."<br>Логин пользователя: ".$result[1];
                return $info;
            }           
        }
        return 'Пользователь не найден<br>';
    }

    public function delete($id)
    {
        $data = @file($this->fname);
        $f = fopen($this->fname, "w");
        $nevData = array();
        $check = 0;
        $count = count($data);
        for ($i=0; $i < $count; $i++) 
        { 
            $result = explode ('|', $data[$i]);
            
            if ($result[0] == $id) 
            {
                unset($data[$i]);
                echo 'Пользователь успешно удалён!<br>';
                $check = 1;
                if ($_SESSION['login'] == $id) {
                    echo 'Вы удалили свой аккаунт, зарегистрируйтесь повторно.';
                    $_SESSION['login'] = false;
                }
                
            }else {
                $nevData[] = $data[$i];
            }  

        }
        
        fputs($f,implode("",$nevData));
        fclose($f);

        if (!$check) 
        {
            return 'Пользователь с указонным id не существует<br>';
        }        
    }
}
